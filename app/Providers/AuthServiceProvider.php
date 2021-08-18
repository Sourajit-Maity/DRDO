<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuperAdmin', function($user) {
            return $user->role == '1';
         });
        
         Gate::define('isAdmin', function($user) {
             return $user->role == '2';
         });
         Gate::define('isClusterHead', function($user) {
            return $user->role == '3';
        });
       
         Gate::define('isECRM', function($user) {
            return $user->role == '4';
        });
        Gate::define('isBDM', function($user) {
            return $user->role == '5';
        });
        Gate::define('isTeamLeader', function($user) {
            return $user->role == '6';
        });

         Gate::define('isACW', function($user) {
             return $user->role == '7';
         });
    }
}
