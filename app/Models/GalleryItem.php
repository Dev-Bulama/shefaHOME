<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'title', 'caption', 'file_path', 'type',
        'category', 'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function getFileUrlAttribute(): string
    {
        return asset('uploads/' . $this->file_path);
    }

    public function scopeActive($q)  { return $q->where('is_active', true)->orderBy('sort_order'); }
    public function scopeFeatured($q){ return $q->where('is_featured', true); }
    public function scopeCategory($q, string $cat) { return $q->where('category', $cat); }
}
