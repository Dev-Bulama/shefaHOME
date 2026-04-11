<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Career extends Model {
    use HasSlug;
    protected $fillable = ['title','slug','department','location','type','summary','description','requirements','salary_range','deadline','is_active'];
    protected $casts = ['is_active'=>'boolean','deadline'=>'date'];
    public function getSlugOptions(): SlugOptions { return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug'); }
    public function applications() { return $this->hasMany(CareerApplication::class); }
    public function getTypeFormattedAttribute() { return str_replace('_',' ',ucfirst($this->type)); }
}
