<?php

namespace App\Models;

use App\Contracts\HasMultilingualFields;
use App\Observers\MultilingualFieldsObserver;
use Illuminate\Database\Eloquent\Model;

class Content extends Model implements HasMultilingualFields
{
    protected $casts = [
        'body' => 'array',
    ];
    protected static function booted()
    {
        static::observe(MultilingualFieldsObserver::class);
    }
    public static function getMultilingualFields(): array
    {
        return ['body'];
    }
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_content');
    }
}
