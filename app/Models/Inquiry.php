<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model {
    protected $fillable = ['name','email','phone','subject','message','property_id','status','read_at'];
    protected $casts = ['read_at'=>'datetime'];
    public function property() { return $this->belongsTo(Property::class); }
    public function scopeUnread($q) { return $q->where('status','new'); }
}
