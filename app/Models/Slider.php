<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;

    public $translatable = ['title'];

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
