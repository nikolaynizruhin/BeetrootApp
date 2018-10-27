<?php

namespace App\Providers;

use App\Policies\TagPolicy;
use App\Tag;
use App\User;
use App\Client;
use App\Office;
use App\Policies\UserPolicy;
use App\Policies\ClientPolicy;
use App\Policies\OfficePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Client::class => ClientPolicy::class,
        Office::class => OfficePolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->is_admin) {
                return true;
            }
        });
    }
}
