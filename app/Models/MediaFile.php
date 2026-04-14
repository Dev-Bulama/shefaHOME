<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $fillable = [
        'filename', 'original_name', 'mime_type', 'type',
        'size', 'alt_text', 'caption', 'folder',
    ];

    public function getUrlAttribute(): string
    {
        return asset('uploads/' . $this->filename);
    }

    public function getHumanSizeAttribute(): string
    {
        $bytes = $this->size;
        if ($bytes >= 1048576) return round($bytes / 1048576, 1) . ' MB';
        if ($bytes >= 1024)    return round($bytes / 1024, 1) . ' KB';
        return $bytes . ' B';
    }

    public function scopeImages($q) { return $q->where('type', 'image'); }
    public function scopeVideos($q) { return $q->where('type', 'video'); }
}
