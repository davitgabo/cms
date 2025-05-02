<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
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

        static::creating(function (Event $event) {
            if (!$event->order) {
                $event->order = Event::max('order') + 1;
            }
        });
    }
    protected static function booted()
    {
        static::created(function (Event $event) {
            $event->slug = 'events/' . Str::slug($event->title['ka']) . '-' . $event->id;
            $event->saveQuietly();
        });

        static::updated(function (Event $event) {
            $event->slug = 'events/' . Str::slug($event->title['ka']) . '-' . $event->id;
            $event->saveQuietly();
        });

        static::deleting(function (Event $event) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
        });

    }
}
