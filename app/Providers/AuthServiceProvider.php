<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('actions-admin', function ($user) {
        //     return $user->isAdmin();
        // });

        // Gate::define('actions-editor', function ($user) {
        //     return $user->isEditor();
        // });

        // Gate::define('actions-creator', function ($user) {
        //     return $user->isCreator();
        // });

        // Gate::define('actions-reader', function ($user) {
        //     return $user->isReader();
        // });

        Gate::define('manage-users', function ($user) {
            return $user->hasAnyRole(['admin']);
        });

        Gate::define('updateDelete-users', function ($user) {
            return $user->hasAnyRole(['editor', 'admin']);
        });

        Gate::define('create-users', function ($user) {
            return $user->hasAnyRole(['editor', 'admin', 'creator']);
        });

        Gate::define('read-users', function ($user) {
            return $user->hasAnyRole(['editor', 'admin', 'creator', 'reader']);
        });
    }
}
