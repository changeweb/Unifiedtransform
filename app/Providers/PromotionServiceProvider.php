<?php

namespace App\Providers;

use App\Interfaces\PromotionRepository;
use App\Repositories\PromotionRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class PromotionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PromotionRepository::class, PromotionRepositoryImpl::class);
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
