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

        // b40deep added gates here
        // Gate::define( 'comments_edit', fn(\App\Models\User $user) => $user->is_admin );
        // Gate::define( 'comments_delete', fn(\App\Models\User $user, $commenter) => $user->is_admin || (auth()->check() && $user->name == $commenter) );
        Gate::define( 'posts_edit', fn(\App\Models\User $user, \App\Models\Post $post) => $user->is_admin || (auth()->check() && $post->user_id == auth()->id()) );
        Gate::define( 'user_logged_in', fn() => (auth()->check()) );
    }
}
