<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Company;
use App\Policies\CompanyPolicy;
use App\Models\Employee;
use App\Policies\EmployeePolicy;
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
        Gate::define('company-delete', [CompanyPolicy::class, 'delete']);
        Gate::define('company-create', [CompanyPolicy::class, 'create']);
        Gate::define('company-update', [CompanyPolicy::class, 'update']);
        Gate::define('employee-delete', [EmployeePolicy::class, 'delete']);
        Gate::define('employee-create', [EmployeePolicy::class, 'create']);
        Gate::define('employee-update', [EmployeePolicy::class, 'update']);
    }
}
