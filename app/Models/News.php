<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class News extends Model
{
    protected $casts = [
        'title' => 'array',
        'short_description' => 'array',
        'full_description' => 'array',
        'publish' => 'boolean',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function (News $news) {
            if (!$news->order) {
                $news->order = News::max('order') + 1;
            }
        });
    }

    protected static function booted()
    {
        static::saved(function (News $news) {
            // For newly created menus, id is now guaranteed
            $news->slug = 'news/' . Str::slug($news->title['ka']) . '-' . $news->id;
            $news->saveQuietly();
        });

        static::deleting(function (News $news) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
        });

    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function galleries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Gallery::class);
    }
}
