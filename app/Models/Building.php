<?php

namespace App\Models;

use App\Contracts\HasMultilingualFields;
use App\Observers\MultilingualFieldsObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model implements HasMultilingualFields
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

    public function floors(): HasMany
    {
        return $this->hasMany(Floor::class);
    }

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }
}
