<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SemesterRepository;
use App\Interfaces\SemesterInterface;

class SemesterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SemesterInterface::class, SemesterRepository::class);
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
