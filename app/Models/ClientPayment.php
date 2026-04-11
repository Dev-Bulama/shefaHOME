<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ClientPayment extends Model {
    protected $fillable = ['client_profile_id','property_id','reference','total_amount','amount_paid','balance','payment_plan','status','next_due_date'];
    protected $casts = ['next_due_date'=>'date','total_amount'=>'decimal:2','amount_paid'=>'decimal:2','balance'=>'decimal:2'];
    public function clientProfile() { return $this->belongsTo(ClientProfile::class); }
    public function property() { return $this->belongsTo(Property::class); }
    public function getProgressPercentageAttribute() {
        return $this->total_amount > 0 ? round(($this->amount_paid / $this->total_amount) * 100) : 0;
    }
}
