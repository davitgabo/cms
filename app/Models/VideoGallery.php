<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class VideoGallery extends Model
{
    use HasTranslations;

    public $translatable = ['title','description'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

}
