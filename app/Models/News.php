<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'publish' => 'boolean',
    ];
    protected static function booted()
    {
        parent::boot();

        static::created(function (News $news) {
            // For newly created menus, id is now guaranteed
            $news->slug = 'news/' . Str::slug($news->title['ka']) . '-' . $news->id;
            $news->saveQuietly();
        });

        static::updated(function (News $news) {
            // On update, id is guaranteed, refresh slug
            $news->slug = 'news/' . Str::slug($news->name['ka']) . '-' . $news->id;
            $news->saveQuietly();
        });

        static::deleting(function ($news) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
        });

    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
