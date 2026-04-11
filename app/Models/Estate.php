<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Estate extends Model {
    use HasSlug;
    protected $fillable = ['name','slug','state','description','cover_image','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function getSlugOptions(): SlugOptions { return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug'); }
    public function properties() { return $this->hasMany(Property::class); }
    public function getCoverImageUrlAttribute() { return $this->cover_image ? asset('storage/'.$this->cover_image) : null; }
}
