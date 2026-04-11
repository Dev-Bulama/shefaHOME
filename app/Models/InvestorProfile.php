<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InvestorProfile extends Model {
    protected $fillable = ['user_id','investor_id','company_name','rc_number','investor_type','total_invested','total_returns','tier','account_manager','notes','is_verified','verified_at'];
    protected $casts = ['is_verified'=>'boolean','verified_at'=>'datetime','total_invested'=>'decimal:2','total_returns'=>'decimal:2'];
    public function user() { return $this->belongsTo(User::class); }
    public function returns() { return $this->hasMany(InvestorReturn::class); }
    public function documents() { return $this->hasMany(InvestorDocument::class); }
    public function getTierColorAttribute() {
        return match($this->tier) { 'platinum'=>'#E5E4E2', 'gold'=>'#C9A84C', 'silver'=>'#C0C0C0', default=>'#CD7F32' };
    }
}
