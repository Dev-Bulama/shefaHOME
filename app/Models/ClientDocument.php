<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ClientDocument extends Model {
    protected $fillable = ['client_profile_id','title','file_path','type','uploaded_by'];
    public function clientProfile() { return $this->belongsTo(ClientProfile::class); }
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
}
