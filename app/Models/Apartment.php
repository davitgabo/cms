<?php

namespace App\Models;

use App\Contracts\HasMultilingualFields;
use App\Observers\MultilingualFieldsObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model implements HasMultilingualFields
{
    protected $casts = [
        'title' => 'array',
    ];

    public static function getMultilingualFields(): array
    {
        return ['title'];
    }

    protected static function booted(): void
    {
        static::observe(MultilingualFieldsObserver::class);
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class);
    }

}
