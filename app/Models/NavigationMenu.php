<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    protected $fillable = [
        'label', 'url', 'location', 'parent_id',
        'sort_order', 'opens_new_tab', 'is_active',
    ];

    protected $casts = [
        'opens_new_tab' => 'boolean',
        'is_active'     => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(NavigationMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeForLocation($query, string $location)
    {
        return $query->where(function ($q) use ($location) {
            $q->where('location', $location)->orWhere('location', 'both');
        });
    }
}
