<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model {
    protected $fillable = ['name','slug','sort_order'];
    public function faqs() { return $this->hasMany(Faq::class)->where('is_active',true)->orderBy('sort_order'); }
}
