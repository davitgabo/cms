<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_content');
    }
}
