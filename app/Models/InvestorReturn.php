<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InvestorReturn extends Model {
    protected $fillable = ['investor_profile_id','property_id','reference','amount_invested','return_amount','return_percentage','investment_date','maturity_date','status','notes'];
    protected $casts = ['investment_date'=>'date','maturity_date'=>'date','amount_invested'=>'decimal:2','return_amount'=>'decimal:2','return_percentage'=>'decimal:2'];
    public function investorProfile() { return $this->belongsTo(InvestorProfile::class); }
    public function property() { return $this->belongsTo(Property::class); }
}
