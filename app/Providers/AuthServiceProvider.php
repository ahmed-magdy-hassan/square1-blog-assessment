<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
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

        /**
         * Users
         */
        Gate::define('show-users', [UserPolicy::class, 'viewAny']);
        Gate::define('create-user', [UserPolicy::class, 'create']);
        Gate::define('update-user', [UserPolicy::class, 'update']);

        /**
         * Posts
         */
        Gate::define('show-post', [PostPolicy::class, 'view']);
    }
}
