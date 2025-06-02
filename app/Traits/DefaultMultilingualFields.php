<?php

namespace App\Traits;

trait DefaultMultilingualFields
{
    public static function getMultilingualFields(): array
    {
        return ['title', 'short_description', 'full_description'];
    }
}
