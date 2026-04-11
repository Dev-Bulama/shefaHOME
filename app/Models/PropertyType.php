<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PropertyType extends Model {
    use HasSlug;
    protected $fillable = ['name','slug','icon','description'];
    public function getSlugOptions(): SlugOptions { return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug'); }
    public function properties() { return $this->hasMany(Property::class); }
}
