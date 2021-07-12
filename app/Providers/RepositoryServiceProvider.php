<?php

namespace App\Providers;

use App\Repositories\TenantRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\ITenantRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ITenantRepository::class,
            TenantRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
