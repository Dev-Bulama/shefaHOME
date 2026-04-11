<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
                $view->with(compact('siteName', 'whatsapp', 'phone1', 'email'));
            } catch (\Exception $e) {
                $view->with([
                    'siteName' => 'SHEFAHOMES',
                    'whatsapp' => '2348000000000',
                    'phone1'   => '+234 800 000 0000',
                    'email'    => 'info@shefahomes.com',
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
