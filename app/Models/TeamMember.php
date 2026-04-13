<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model {
    protected $fillable = ['name','position','department','bio','photo','email','linkedin','twitter','sort_order','is_featured','is_active'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean'];
    public function getPhotoUrlAttribute() { return $this->photo ? asset('uploads/'.$this->photo) : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=1A237E&color=27AE22'; }
    public function scopeActive($q) { return $q->where('is_active', true)->orderBy('sort_order'); }
}
