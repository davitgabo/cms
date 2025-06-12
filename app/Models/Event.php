<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'short_description', 'full_description'];

    protected $casts = [
        'title' => 'array',
        'short_description' => 'array',
        'full_description' => 'array',
        'publish' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Event $event) {
            if (!$event->order) {
                $event->order = Event::max('order') + 1;
            }
        });
    }
    protected static function booted()
    {
        static::saved(function (Event $event) {
            $event->slug = 'events/' . Str::slug($event->getTranslation('title','ka')) . '-' . $event->id;
            $event->saveQuietly();
        });

        static::deleting(function (Event $event) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
        });

    }
}
