<?php

namespace App\Models;

use App\Contracts\HasMultilingualFields;
use App\Observers\MultilingualFieldsObserver;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model implements HasMultilingualFields
{
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public static function getMultilingualFields(): array
    {
        return ['title', 'description'];
    }

    protected static function booted()
    {
        static::observe(MultilingualFieldsObserver::class);
    }

}
