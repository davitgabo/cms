<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    protected $casts = [
        'name' => 'array',
        'publish' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            if (!$menu->order) {
                $menu->order = Menu::max('order') + 1;
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'menu_content');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class);
    }

    public static function scopeTree($query)
    {
        return $query->with('children')->whereNull('parent_id')->orderBy('order');
    }

    public function getDepthAttribute()
    {
        $depth = 0;
        $parent = $this->parent;

        while ($parent) {
            $depth++;
            $parent = $parent->parent;
        }

        return $depth;
    }

    protected static function booted()
    {
        static::created(function (Menu $menu) {
            // For newly created menus, id is now guaranteed
            $menu->slug = Str::slug($menu->name['ka']) . '-' . $menu->id;
            $menu->saveQuietly();
        });

        static::updated(function (Menu $menu) {
            // On update, id is guaranteed, refresh slug
            $menu->slug = Str::slug($menu->name['ka']) . '-' . $menu->id;
            $menu->saveQuietly();
        });

    }


}
