<?php

namespace App\Enums;

enum ApartmentStatus: string
{
    case FREE = 'free';
    case RESERVED = 'reserved';
    case SOLD = 'sold';

    public function getLabel(): string
    {
        return match($this) {
            self::FREE => 'Free',
            self::RESERVED => 'Reserved',
            self::SOLD => 'Sold',
        };
    }
}
