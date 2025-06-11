<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    protected $casts = [
        'title' => 'array',
    ];

    public function floors(): HasMany
    {
        return $this->hasMany(Floor::class);
    }

    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class);
    }
}
