<?php

namespace App\Models;

use App\Contracts\HasMultilingualFields;
use App\Observers\MultilingualFieldsObserver;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model implements HasMultilingualFields
{
    protected $casts = [
        'title' => 'array',
    ];

    public static function getMultilingualFields(): array
    {
        return ['title'];
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Slider $slider) {
            if (!$slider->order) {
                $slider->order = Slider::max('order') + 1;
            }
        });
    }
    public static function booted()
    {
        static::observe(MultilingualFieldsObserver::class);
    }
}
