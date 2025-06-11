<?php

namespace App\Models;

use App\Enums\ApartmentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apartment extends Model
{
    protected $casts = [
        'title' => 'array',
        'status' => ApartmentStatus::class,
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function floor(): BelongsTo
    {
        return $this->belongsTo(Floor::class);
    }

}
