<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model {
    protected $fillable = ['name','logo','website','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function getLogoUrlAttribute() { return asset('uploads/'.$this->logo); }
}
