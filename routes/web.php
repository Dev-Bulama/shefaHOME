<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PropertyController as PublicPropertyController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\BlogController as PublicBlogController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\CareerController as PublicCareerController;
use App\Http\Controllers\Public\TestimonialController as PublicTestimonialController;
use App\Http\Controllers\Public\VirtualTourController;
use App\Http\Controllers\Public\FaqController as PublicFaqController;
use App\Http\Controllers\Public\InvestorInfoController;
use App\Http\Controllers\Public\InquiryController as PublicInquiryController;
use App\Http\Controllers\Public\NewsletterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Investor;
use App\Http\Controllers\Client;

// Dashboard redirect after login
Route::get('/dashboard-redirect', function() {
    if(auth()->check()) {
        $user = auth()->user();
        if($user->hasAnyRole(['super_admin','admin','staff'])) return redirect()->route('admin.dashboard');
        if($user->hasRole('investor')) return redirect()->route('investor.dashboard');
        return redirect()->route('client.dashboard');
    }
    return redirect()->route('login');
})->name('dashboard.redirect')->middleware('auth');

// PUBLIC ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PublicPropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{slug}', [PublicPropertyController::class, 'show'])->name('properties.show');
Route::get('/about-us', [AboutController::class, 'index'])->name('about');
Route::get('/blog', [PublicBlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [PublicBlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{slug}', [PublicBlogController::class, 'category'])->name('blog.category');
Route::get('/careers', [PublicCareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{slug}', [PublicCareerController::class, 'show'])->name('careers.show');
Route::post('/careers/{slug}/apply', [PublicCareerController::class, 'apply'])->name('careers.apply');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/virtual-tour', [VirtualTourController::class, 'index'])->name('virtual-tour');
Route::get('/testimonials', [PublicTestimonialController::class, 'index'])->name('testimonials');
Route::get('/faqs', [PublicFaqController::class, 'index'])->name('faqs');
Route::get('/investor-info', [InvestorInfoController::class, 'index'])->name('investor-info');
Route::post('/inquiries', [PublicInquiryController::class, 'store'])->name('inquiries.store');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/terms-and-conditions', fn() => view('public.pages.terms'))->name('terms');
Route::get('/privacy-policy', fn() => view('public.pages.privacy'))->name('privacy');
Route::get('/client-partnership', fn() => view('public.pages.partnership'))->name('partnership');

// ADMIN AUTH
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login')->middleware('guest');

// INVESTOR AUTH
Route::get('/investor/login', [AuthController::class, 'showInvestorLogin'])->name('investor.login')->middleware('guest');

// CLIENT AUTH
Route::get('/client/login', [AuthController::class, 'showClientLogin'])->name('client.login')->middleware('guest');

// ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', Admin\PropertyController::class);
    Route::post('properties/{id}/gallery', [Admin\PropertyController::class, 'uploadGallery'])->name('properties.gallery.upload');
    Route::delete('properties/{id}/gallery/{imageId}', [Admin\PropertyController::class, 'deleteGalleryImage'])->name('properties.gallery.delete');
    Route::post('properties/gallery/reorder', [Admin\PropertyController::class, 'reorderGallery'])->name('properties.gallery.reorder');
    Route::resource('sliders', Admin\SliderController::class);
    Route::post('sliders/reorder', [Admin\SliderController::class, 'reorder'])->name('sliders.reorder');
    Route::resource('team', Admin\TeamController::class);
    Route::resource('testimonials', Admin\TestimonialController::class);
    Route::resource('blog', Admin\BlogController::class);
    Route::resource('blog-categories', Admin\BlogCategoryController::class);
    Route::resource('careers', Admin\CareerController::class);
    Route::get('career-applications', [Admin\CareerController::class, 'applications'])->name('careers.applications');
    Route::get('career-applications/{id}', [Admin\CareerController::class, 'showApplication'])->name('careers.applications.show');
    Route::patch('career-applications/{id}/status', [Admin\CareerController::class, 'updateApplicationStatus'])->name('careers.applications.update-status');
    Route::resource('faqs', Admin\FaqController::class);
    Route::resource('faq-categories', Admin\FaqCategoryController::class);
    Route::get('inquiries', [Admin\InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('inquiries/{id}', [Admin\InquiryController::class, 'show'])->name('inquiries.show');
    Route::patch('inquiries/{id}/status', [Admin\InquiryController::class, 'updateStatus'])->name('inquiries.status');
    Route::get('clients', [Admin\ClientController::class, 'index'])->name('clients.index');
    Route::get('clients/{id}', [Admin\ClientController::class, 'show'])->name('clients.show');
    Route::post('clients/{id}/payments', [Admin\ClientController::class, 'addPayment'])->name('clients.payments.add');
    Route::post('clients/{id}/documents', [Admin\ClientController::class, 'uploadDocument'])->name('clients.documents.upload');
    Route::get('investors', [Admin\InvestorController::class, 'index'])->name('investors.index');
    Route::get('investors/{id}', [Admin\InvestorController::class, 'show'])->name('investors.show');
    Route::patch('investors/{id}/approve', [Admin\InvestorController::class, 'approve'])->name('investors.approve');
    Route::post('investors/{id}/returns', [Admin\InvestorController::class, 'addReturn'])->name('investors.returns.add');
    Route::post('investors/{id}/documents', [Admin\InvestorController::class, 'uploadDocument'])->name('investors.documents.upload');
    Route::get('settings', [Admin\SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [Admin\SettingsController::class, 'update'])->name('settings.update');
    Route::resource('awards', Admin\AwardController::class);
    Route::resource('partners', Admin\PartnerController::class);
    Route::resource('stats', Admin\StatController::class);
    // System Update
    Route::get('system-update', [Admin\SystemUpdateController::class, 'index'])->name('system-update.index');
    Route::post('system-update', [Admin\SystemUpdateController::class, 'upload'])->name('system-update.upload');
    // Property types and estates
    Route::resource('property-types', Admin\PropertyTypeController::class);
    Route::resource('estates', Admin\EstateController::class);
    // Newsletter
    Route::get('newsletter', [Admin\NewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('newsletter/{id}', [Admin\NewsletterController::class, 'destroy'])->name('newsletter.destroy');
    // Virtual Tours
    Route::resource('virtual-tours', Admin\VirtualTourController::class);
});

// INVESTOR ROUTES
Route::prefix('investor')->name('investor.')->middleware(['auth', 'investor'])->group(function () {
    Route::get('/dashboard', [Investor\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/portfolio', [Investor\PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/{id}', [Investor\PortfolioController::class, 'show'])->name('portfolio.show');
    Route::get('/returns', [Investor\ReturnsController::class, 'index'])->name('returns.index');
    Route::get('/returns/statement', [Investor\ReturnsController::class, 'statement'])->name('returns.statement');
    Route::get('/documents', [Investor\DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{id}/download', [Investor\DocumentController::class, 'download'])->name('documents.download');
    Route::get('/profile', [Investor\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [Investor\ProfileController::class, 'update'])->name('profile.update');
});

// CLIENT ROUTES
Route::prefix('client')->name('client.')->middleware(['auth', 'client'])->group(function () {
    Route::get('/dashboard', [Client\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/properties', [Client\PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{id}', [Client\PropertyController::class, 'show'])->name('properties.show');
    Route::get('/payments', [Client\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/make', [Client\PaymentController::class, 'make'])->name('payments.make');
    Route::post('/payments', [Client\PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/verify', [Client\PaymentController::class, 'verify'])->name('payments.verify');
    Route::get('/payments/receipt/{id}', [Client\PaymentController::class, 'receipt'])->name('payments.receipt');
    Route::get('/documents', [Client\DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{id}/download', [Client\DocumentController::class, 'download'])->name('documents.download');
    Route::post('/documents/upload', [Client\DocumentController::class, 'upload'])->name('documents.upload');
    Route::get('/profile', [Client\ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [Client\ProfileController::class, 'update'])->name('profile.update');
});
