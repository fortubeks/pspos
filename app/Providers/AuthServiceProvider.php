<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Blade;
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

        Blade::if('role', function ($role) {
            $user = auth()->user();
            $authorized = false;
            switch ($role) {
                case 'admin':
                    $authorized = $user->user_type == "SUPER_ADMIN" || $user->user_type == "MANAGER";
                    break;
                case 'user':
                    $authorized = $user->user_type == "ATTENDANT" || $user->user_type == "EMPLOEYEE";
                    break;
                default:
                    break;
            }
            return $authorized;
        });
    }
}
