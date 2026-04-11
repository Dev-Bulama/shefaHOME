<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Property extends Model {
    use HasSlug, SoftDeletes;
    protected $fillable = ['title','slug','property_type_id','estate_id','short_description','description','state','lga','address','latitude','longitude','price_from','price_to','plot_sizes','payment_plans','cover_image','is_featured','is_active','status','virtual_tour_url','video_url','total_units','available_units'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean','price_from'=>'decimal:2','price_to'=>'decimal:2'];

    public function getSlugOptions(): SlugOptions { return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug'); }
    public function propertyType() { return $this->belongsTo(PropertyType::class); }
    public function estate() { return $this->belongsTo(Estate::class); }
    public function galleries() { return $this->hasMany(PropertyGallery::class)->orderBy('sort_order'); }
    public function inquiries() { return $this->hasMany(Inquiry::class); }
    public function virtualTours() { return $this->hasMany(VirtualTour::class); }
    public function clientProperties() { return $this->hasMany(ClientProperty::class); }
    public function investorReturns() { return $this->hasMany(InvestorReturn::class); }

    public function getCoverImageUrlAttribute() { return asset('storage/'.$this->cover_image); }
    public function getPlotSizesArrayAttribute() { return $this->plot_sizes ? json_decode($this->plot_sizes, true) : []; }
    public function getPaymentPlansArrayAttribute() { return $this->payment_plans ? json_decode($this->payment_plans, true) : []; }
    public function getFormattedPriceAttribute() { return '₦'.number_format($this->price_from); }

    public function scopeFeatured($q) { return $q->where('is_featured', true)->where('is_active', true); }
    public function scopeAvailable($q) { return $q->where('status', 'available')->where('is_active', true); }
}
