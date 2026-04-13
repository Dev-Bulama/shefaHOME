<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Settings;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register Settings helper as singleton
        $this->app->singleton('settings', function () {
            return new Settings();
        });
    }

    public function boot(): void
    {
        // Share settings and site data globally to all views
        View::composer('*', function ($view) {
            try {
                $siteName = Settings::get('site_name', 'SHEFAHOMES');
                $whatsapp = Settings::get('whatsapp_number', '2348000000000');
                $phone1   = Settings::get('phone_1', '+234 800 000 0000');
                $email    = Settings::get('contact_email', 'info@shefahomes.com');

                // Full header navigation tree (used by navbar)
                $navHeaderItems = collect();
                // Legacy alias used in some older views
                $navMenuItems   = collect();
                if (Schema::hasTable('navigation_menus')) {
                    $navHeaderItems = \App\Models\NavigationMenu::with(['children' => function ($q) {
                            $q->where('is_active', true)->orderBy('sort_order');
                        }])
                        ->active()
                        ->topLevel()
                        ->forLocation('header')
                        ->orderBy('sort_order')
                        ->get();
                    // Legacy: extras that previously went only into Company dropdown
                    $navMenuItems = $navHeaderItems;
                }

                $view->with(compact('siteName', 'whatsapp', 'phone1', 'email', 'navHeaderItems', 'navMenuItems'));
            } catch (\Throwable $e) {
                $view->with([
                    'siteName'      => 'SHEFAHOMES',
                    'whatsapp'      => '2348000000000',
                    'phone1'        => '+234 800 000 0000',
                    'email'         => 'info@shefahomes.com',
                    'navHeaderItems'=> collect(),
                    'navMenuItems'  => collect(),
                ]);
            }
        });

        // Register custom Blade directives
        Blade::directive('settings', function ($key) {
            return "<?php echo \\App\\Helpers\\Settings::get($key); ?>";
        });

        Blade::directive('naira', function ($amount) {
            return "<?php echo '₦' . number_format($amount, 2); ?>";
        });
    }
}
