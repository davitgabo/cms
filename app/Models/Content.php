<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Content extends Model
{
    use HasTranslations;

    public $translatable = ['body'];

    protected $casts = [
        'body' => 'array',
    ];
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_content');
    }
}
