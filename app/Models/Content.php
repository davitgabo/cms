<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $casts = [
        'body' => 'array',
    ];
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_content');
    }
}
