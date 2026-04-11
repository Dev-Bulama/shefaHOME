<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Award extends Model {
    protected $fillable = ['title','year','image','description','sort_order'];
    public function getImageUrlAttribute() { return $this->image ? asset('storage/'.$this->image) : null; }
}
