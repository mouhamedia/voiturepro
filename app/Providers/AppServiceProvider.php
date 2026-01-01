<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\CurrencyHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Blade directive pour formater en XOF
        Blade::directive('xof', function ($amount) {
            return "<?php echo \App\Helpers\CurrencyHelper::formatXOF($amount); ?>";
        });

        // Blade directive pour le format court
        Blade::directive('xofshort', function ($amount) {
            return "<?php echo \App\Helpers\CurrencyHelper::formatXOFShort($amount); ?>";
        });

        // Rendre le helper disponible partout
        view()->share('currency', CurrencyHelper::class);
    }
}

