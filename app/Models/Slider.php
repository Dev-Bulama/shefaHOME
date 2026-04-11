<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model {
    protected $fillable = ['title','subtitle','image','cta_text','cta_url','cta_text_2','cta_url_2','text_position','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function getImageUrlAttribute() { return asset('storage/'.$this->image); }
    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('sort_order'); }
}
