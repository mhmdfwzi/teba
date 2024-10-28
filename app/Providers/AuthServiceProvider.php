<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Delivery' => 'App\Policies\Delivery\DeliveryPolicy',
    ];

    public function register(){
        parent::register();

        $this->app->bind('abilities',function(){
            return include base_path('data/permissions.php');
        });
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // check if user super-admin
        $admin = Auth::user('admin');
        Gate::before(function($admin,$ability){
            if($admin->super_admin == 1){
                return true;
            }
        });

        // foreach($this->app->make('abilities') as $code => $label ){
        //     Gate::define($code,function($user) use ($code){
        //         return $user->hasAbility($code);
        //     });
        // }

    }
}