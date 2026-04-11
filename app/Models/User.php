<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasFactory, Notifiable, SoftDeletes, HasRoles;
    protected $fillable = ['name','email','phone','avatar','portal','is_active','is_verified','password'];
    protected $hidden = ['password','remember_token'];
    protected $casts = ['email_verified_at'=>'datetime','is_active'=>'boolean','is_verified'=>'boolean','password'=>'hashed'];

    public function investorProfile() { return $this->hasOne(InvestorProfile::class); }
    public function clientProfile() { return $this->hasOne(ClientProfile::class); }
    public function blogPosts() { return $this->hasMany(BlogPost::class, 'author_id'); }
    public function isAdmin() { return $this->hasRole(['super_admin','admin','staff']); }
    public function isInvestor() { return $this->hasRole('investor'); }
    public function isClient() { return $this->hasRole('client'); }
    public function getAvatarUrlAttribute() {
        return $this->avatar ? asset('storage/'.$this->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&background=C9A84C&color=fff';
    }
}
