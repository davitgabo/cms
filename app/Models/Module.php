<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
}
