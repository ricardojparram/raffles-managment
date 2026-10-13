<?php

namespace App\Enums;

enum TeamRole: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case SELLER = 'seller';
    case VIEWER = 'viewer';

    public function label(): string
    {
        return match ($this) {
            self::OWNER => __('Owner'),
            self::ADMIN => __('Admin'),
            self::SELLER => __('Seller'),
            self::VIEWER => __('Viewer'),
        };
    }

    public static function fromString(?string $role): self
    {
        return match ($role) {
            'owner' => self::OWNER,
            'admin' => self::ADMIN,
            'seller' => self::SELLER,
            'viewer', 'member' => self::VIEWER,
            default => self::VIEWER,
        };
    }

    public function isOwner(): bool
    {
        return $this === self::OWNER;
    }

    public function isAdmin(): bool
    {
        return $this === self::OWNER || $this === self::ADMIN;
    }

    public function canManageRaffles(): bool
    {
        return $this->isAdmin();
    }

    public function canManagePayments(): bool
    {
        return $this->isAdmin();
    }

    public function canSell(): bool
    {
        return $this->isAdmin() || $this === self::SELLER;
    }
}
