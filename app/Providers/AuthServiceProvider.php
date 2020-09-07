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

        Gate::define('isAdmin', function ($user) {
            $roleId=$user->role_id;
            $userId=$user->id;

            switch($roleId){
                case 1:
                    return true;
                    break;
                default :
                    return false;
            }
        });
        Gate::define('isVendor', function ($user) {
            $roleId=$user->role_id;
            $userId=$user->id;

            switch($roleId){
                case 2:
                    return true;
                    break;
                default :
                    return false;
            }
        });
        Gate::define('isAdminAuthor', function ($user) {
            $roleId=$user->role_id;
            $userId=$user->id;

            switch($roleId){
                case 1:
                    return true;
                    break;
                case 2:
                    return true;
                    break;
                default :
                    return false;
            }
        });
        Gate::define('isAdminAuthorVendor', function ($user) {
            $roleId=$user->role_id;
            $userId=$user->id;

            switch($roleId){
                case 1:
                    return true;
                    break;
                case 2:
                    return true;
                    break;
                case 4:
                    return true;
                    break;
                default :
                    return false;
            }
        });
        Gate::define('isCustomer', function ($user) {
            $roleId=$user->role_id;
            $userId=$user->id;

            switch($roleId){
                case 3:
                    return true;
                    break;
                default :
                    return false;
            }
        });
        Gate::define('isAuthor', function ($user) {
            $roleId=$user->role_id;
            $userId=$user->id;

            switch($roleId){
                case 4:
                    return true;
                    break;
                default :
                    return false;
            }
        });
    }
}
