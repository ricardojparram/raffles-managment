<?php

namespace App\Actions;

use App\Enums\PaymentStatus;
use App\Exceptions\ReservationFailed;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Raffle;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Records a buyer's reported payment and holds the chosen numbers until the organizer reviews it.
 */
class ReserveTickets
{
    public const PROOF_DISK = 'local';

    /**
     * @param  array{dni: string, name: string, lastname: string, phone: string}  $buyer
     * @param  list<string>  $numbers
     *
     * @throws ReservationFailed
     */
    public function handle(
        Raffle $raffle,
        array $buyer,
        array $numbers,
        PaymentMethod $paymentMethod,
        string $reference,
        UploadedFile $proof,
        ?float $usdToVedRate = null,
    ): Payment {
        $this->ensureSelectionIsValid($raffle, $numbers, $paymentMethod);

        $quote = $paymentMethod->quoteFor(
            $raffle->priceForQuantity(count($numbers)),
            $raffle->currency,
            $usdToVedRate,
        );

        $proofPath = $proof->store("tenant-{$raffle->team_id}/payments", self::PROOF_DISK);

        try {
            return DB::transaction(function () use ($raffle, $buyer, $numbers, $paymentMethod, $reference, $quote, $proofPath): Payment {
                $this->ensureNumbersAreFree($raffle, $numbers);
                $this->ensureReferenceIsNew($paymentMethod, $reference);

                $customer = $raffle->team->customers()->firstOrCreate(
                    ['dni' => $buyer['dni']],
                    Arr::except($buyer, 'dni'),
                );

                $payment = Payment::query()->create([
                    'team_id' => $raffle->team_id,
                    'customer_id' => $customer->id,
                    'raffle_id' => $raffle->id,
                    'payment_method_id' => $paymentMethod->id,
                    'amount' => $quote['amount'],
                    'currency' => $quote['currency'],
                    'exchange_rate' => $quote['exchange_rate'],
                    'status' => PaymentStatus::Pending->value,
                    'payment_date' => now(),
                    'reference' => $reference,
                    'img' => $proofPath,
                ]);

                $payment->tickets()->createMany(array_map(fn (string $number): array => [
                    'raffle_id' => $raffle->id,
                    'customer_id' => $customer->id,
                    'number' => $number,
                ], $numbers));

                return $payment;
            });
        } catch (UniqueConstraintViolationException $exception) {
            Storage::disk(self::PROOF_DISK)->delete($proofPath);

            $taken = $this->takenNumbers($raffle, $numbers);

            throw $taken === [] ? $exception : ReservationFailed::numbersTaken($taken);
        } catch (ReservationFailed $exception) {
            Storage::disk(self::PROOF_DISK)->delete($proofPath);

            throw $exception;
        }
    }

    /**
     * @param  list<string>  $numbers
     *
     * @throws ReservationFailed
     */
    private function ensureSelectionIsValid(Raffle $raffle, array $numbers, PaymentMethod $paymentMethod): void
    {
        if (! $raffle->salesStatus()->isOpen()) {
            throw ReservationFailed::raffleClosed();
        }

        $quantity = count($numbers);
        $minimum = min(max(1, $raffle->minimum_tickets), $raffle->availableTicketsCount());

        $isValid = $paymentMethod->team_id === $raffle->team_id
            && $quantity >= $minimum
            && $quantity <= Raffle::MAX_TICKETS_PER_PURCHASE
            && $quantity === count(array_unique($numbers))
            && array_all($numbers, fn (mixed $number): bool => is_string($number) && $raffle->hasNumber($number));

        if (! $isValid) {
            throw ReservationFailed::invalidSelection();
        }
    }

    /**
     * @param  list<string>  $numbers
     *
     * @throws ReservationFailed
     */
    private function ensureNumbersAreFree(Raffle $raffle, array $numbers): void
    {
        $taken = $this->takenNumbers($raffle, $numbers);

        if ($taken !== []) {
            throw ReservationFailed::numbersTaken($taken);
        }
    }

    /**
     * @throws ReservationFailed
     */
    private function ensureReferenceIsNew(PaymentMethod $paymentMethod, string $reference): void
    {
        $alreadyReported = Payment::query()
            ->withoutGlobalScopes()
            ->where('payment_method_id', $paymentMethod->id)
            ->where('reference', $reference)
            ->where('status', '!=', PaymentStatus::Rejected->value)
            ->exists();

        if ($alreadyReported) {
            throw ReservationFailed::duplicateReference();
        }
    }

    /**
     * @param  list<string>  $numbers
     * @return list<string>
     */
    private function takenNumbers(Raffle $raffle, array $numbers): array
    {
        return $raffle->tickets()->whereIn('number', $numbers)->orderBy('number')->pluck('number')->all();
    }
}
