<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model {
    protected $fillable = ['user_id','client_id','address','state','occupation','nin','bvn','nok_name','nok_phone','nok_relationship'];
    public function user() { return $this->belongsTo(User::class); }
    public function properties() { return $this->hasMany(ClientProperty::class); }
    public function payments() { return $this->hasMany(ClientPayment::class); }
    public function documents() { return $this->hasMany(ClientDocument::class); }
}
