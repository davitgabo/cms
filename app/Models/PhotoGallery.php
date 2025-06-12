<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PhotoGallery extends Model
{
    use HasTranslations;

    public $translatable = ['title'];

    public $casts = [
        'title' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (PhotoGallery $news) {
            if (!$news->order) {
                $news->order = News::max('order') + 1;
            }
        });
    }
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
