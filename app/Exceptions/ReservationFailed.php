<?php

namespace App\Exceptions;

use RuntimeException;

/**
 * A ticket purchase could not be recorded for a reason the buyer can act on.
 */
class ReservationFailed extends RuntimeException
{
    public const RAFFLE_CLOSED = 'raffle_closed';

    public const INVALID_SELECTION = 'invalid_selection';

    public const NUMBERS_TAKEN = 'numbers_taken';

    public const DUPLICATE_REFERENCE = 'duplicate_reference';

    /**
     * @param  list<string>  $numbers
     */
    public function __construct(public readonly string $reason, public readonly array $numbers = [])
    {
        parent::__construct("Ticket reservation failed: {$reason}.");
    }

    public static function raffleClosed(): self
    {
        return new self(self::RAFFLE_CLOSED);
    }

    public static function invalidSelection(): self
    {
        return new self(self::INVALID_SELECTION);
    }

    /**
     * @param  list<string>  $numbers
     */
    public static function numbersTaken(array $numbers): self
    {
        return new self(self::NUMBERS_TAKEN, array_values($numbers));
    }

    public static function duplicateReference(): self
    {
        return new self(self::DUPLICATE_REFERENCE);
    }
}
