<?php

namespace App\Providers;

// -*- Add as GateContract
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        // admin for committee
        $gate->define('isAdmin', function($user){
            return $user->access_id ==1;
        });
    

        // $gate->define('isAuthor', function($user){
        //     return $user->user_type == 'author';
        // });
        // user
        $gate->define('isUser', function($user){
            return $user->access_id == 2;

        });
        $gate->define('isAdviser', function($user){
            return $user->access_id ==3;
        });
        $gate->define('isCommittee', function($user){
            return $user->access_id ==4;
        });
        $gate->define('isCoordinator', function($user){
            return $user->access_id ==5;
        });

      
        


    }
}
