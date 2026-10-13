<?php

namespace App\Enums;

/**
 * Whether the public can buy tickets for a raffle right now, and why not.
 */
enum SalesStatus: string
{
    case Open = 'open';
    case SoldOut = 'sold_out';
    case Closed = 'closed';
    case Finished = 'finished';
    case Canceled = 'canceled';
    case Unpublished = 'unpublished';

    public function isOpen(): bool
    {
        return $this === self::Open;
    }

    public function isPubliclyVisible(): bool
    {
        return $this !== self::Unpublished;
    }

    public function label(): string
    {
        return match ($this) {
            self::Open => __('On sale'),
            self::SoldOut => __('Sold out'),
            self::Closed => __('Sales closed'),
            self::Finished => __('Finished'),
            self::Canceled => __('Canceled'),
            self::Unpublished => __('Unpublished'),
        };
    }

    public function description(): ?string
    {
        return match ($this) {
            self::Open, self::Unpublished => null,
            self::SoldOut => __('Every number has been taken.'),
            self::Closed => __('Sales closed when the draw started.'),
            self::Finished => __('This raffle has already been drawn.'),
            self::Canceled => __('The organizer canceled this raffle.'),
        };
    }
}
