<?php

namespace App\Providers;

use App\Models\Response;
use App\Models\User;
use App\Observers\ResponseObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::observe(ResponseObserver::class);
        User::observe(UserObserver::class);
        $this->gate();
    }

    protected function gate(): void
    {
        Gate::define('admin', function ($user) {
            return in_array($user->email, config("auth.admin_emails"));
        });
    }
}
