<?php

namespace App\Providers;

use App\Employee;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
// Simple authorization with gates
// Gate::before('accessing the route');
        Gate::before(function(Employee $employee, $ability) {
            /**
             * Check if current employee can access the
             */
            return $employee->abilities()->contains($ability);
        });
    }
}
