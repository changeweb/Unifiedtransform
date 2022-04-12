<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AcademicSettingInterface;
use App\Repositories\AcademicSettingRepository;

class AcademicSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AcademicSettingInterface::class, AcademicSettingRepository::class);
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
