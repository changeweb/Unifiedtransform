<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SectionRepository;
use App\Interfaces\SectionInterface;

class SectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SectionInterface::class, SectionRepository::class);
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
