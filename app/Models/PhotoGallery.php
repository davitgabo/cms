<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
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
