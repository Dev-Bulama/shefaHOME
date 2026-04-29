<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogPost extends Model {
    use HasSlug, SoftDeletes;
    protected $fillable = ['title','slug','blog_category_id','author_id','featured_image','excerpt','body','meta_title','meta_description','is_featured','is_published','published_at','views'];
    protected $casts = ['is_featured'=>'boolean','is_published'=>'boolean','published_at'=>'datetime'];

    public function getSlugOptions(): SlugOptions { return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug'); }
    public function category() { return $this->belongsTo(BlogCategory::class, 'blog_category_id'); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }
    public function getFeaturedImageUrlAttribute() { return asset('uploads/'.$this->featured_image); }
    public function getContentAttribute(): string { return $this->body ?? ''; }
    public function scopePublished($q) { return $q->where('is_published', true)->whereNotNull('published_at')->where('published_at','<=',now()); }
}
