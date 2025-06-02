<?php

namespace App\Models;

use App\Contracts\HasMultilingualFields;
use App\Observers\MultilingualFieldsObserver;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model implements HasMultilingualFields
{
    public $casts = [
        'title' => 'array',
    ];

    public static function getMultilingualFields(): array
    {
        return ['title'];
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function (PhotoGallery $news) {
            if (!$news->order) {
                $news->order = News::max('order') + 1;
            }
        });
    }

    protected static function booted()
    {
        static::observe(MultilingualFieldsObserver::class);
    }
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
