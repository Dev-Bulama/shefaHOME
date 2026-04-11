<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InvestorDocument extends Model {
    protected $fillable = ['investor_profile_id','title','file_path','type','uploaded_by'];
    public function investorProfile() { return $this->belongsTo(InvestorProfile::class); }
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
}
