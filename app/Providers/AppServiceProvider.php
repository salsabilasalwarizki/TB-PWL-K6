<?php

namespace App\Providers;
use App\Models\Dataset;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use App\Observers\DatasetObserver;

class AppServiceProvider extends ServiceProvider
{
    
    public function register(): void
    {
        //
    }

    
    public function boot(): void
{
    Dataset::observe(DatasetObserver::class);
   
    Paginator::useBootstrapFive();
    
    
    if (app()->environment('production')) {
        URL::forceScheme('https');
    }
}
}
