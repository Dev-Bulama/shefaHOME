<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = ['client_name','client_title','client_photo','content','rating','property','video_url','is_featured','is_active','sort_order'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean'];
    public function getClientPhotoUrlAttribute() { return $this->client_photo ? asset('uploads/'.$this->client_photo) : 'https://ui-avatars.com/api/?name='.urlencode($this->client_name).'&background=27AE22&color=fff'; }
    public function scopeFeatured($q) { return $q->where('is_featured', true)->where('is_active', true)->orderBy('sort_order'); }
}
