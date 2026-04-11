<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ClientProperty extends Model {
    protected $fillable = ['client_profile_id','property_id','plot_size','purchase_date','notes'];
    protected $casts = ['purchase_date'=>'date'];
    public function clientProfile() { return $this->belongsTo(ClientProfile::class); }
    public function property() { return $this->belongsTo(Property::class); }
    public function payments() { return $this->hasMany(ClientPayment::class, 'client_profile_id', 'client_profile_id'); }
}
