<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SchoolSessionRepository;
use App\Interfaces\SchoolSessionInterface;

class SchoolSessionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SchoolSessionInterface::class, SchoolSessionRepository::class);
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
