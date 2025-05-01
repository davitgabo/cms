<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $casts = [
        'name' => 'array',
    ];
    public function news()
    {
        return $this->belongsToMany(News::class);
    }
}
