<?php

namespace App\Models;

use App\Contracts\HasMultilingualFields;
use App\Observers\MultilingualFieldsObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model implements HasMultilingualFields
{
    protected $casts = [
        'name' => 'array',
        'publish' => 'boolean',
    ];

    public static function getMultilingualFields(): array
    {
        return ['name'];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Menu $menu) {
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
        static::observe(MultilingualFieldsObserver::class);

        static::saved(function ($menu) {
            $expectedSlug = Str::slug($menu->name['ka']) . '-' . $menu->id;
            if ($menu->slug !== $expectedSlug) {
                $menu->slug = $expectedSlug;
                $menu->saveQuietly();
            }

            if ($menu->is_homepage) {
                Menu::where('id', '!=', $menu->id)
                    ->where('is_homepage', true)
                    ->update(['is_homepage' => false]);
            }
        });

    }

    public function scopePublished($query)
    {
        return $query->where('publish', true);
    }
}
