<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SchoolClassRepository;
use App\Interfaces\SchoolClassInterface;

class SchoolClassServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SchoolClassInterface::class, SchoolClassRepository::class);
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
