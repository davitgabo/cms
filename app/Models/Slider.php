<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $casts = [
        'title' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Slider $slider) {
            if (!$slider->order) {
                $slider->order = Slider::max('order') + 1;
            }
        });
    }
}
