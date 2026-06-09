<?php

namespace App\Providers;
use App\Models\Dataset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use App\Observers\DatasetObserver;

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
    Dataset::observe(DatasetObserver::class);
    // Fix pagination URLs for custom primary keys
    Paginator::useBootstrapFive();
    
    // Force HTTPS in production
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
}
}
