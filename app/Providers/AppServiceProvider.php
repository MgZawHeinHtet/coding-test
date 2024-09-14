<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Company;
use App\Policies\CompanyPolicy;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('delete', [CompanyPolicy::class, 'delete']);
        Gate::define('create', [CompanyPolicy::class, 'create']);
        Gate::define('update', [CompanyPolicy::class, 'update']);
    }
}
