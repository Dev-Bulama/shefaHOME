<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class VirtualTour extends Model {
    protected $fillable = ['property_id','title','embed_url','thumbnail','type','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function property() { return $this->belongsTo(Property::class); }
    public function getThumbnailUrlAttribute() { return $this->thumbnail ? asset('uploads/'.$this->thumbnail) : null; }
}
