<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class LanguageHelper
{
    public static function options(): array
    {
        return [
            'ge' => __('Georgian'),
            'en' => __('English'),
        ];
    }

    public static function default(): string
    {
        return Session::get('language') ?? 'ge';
    }
}
