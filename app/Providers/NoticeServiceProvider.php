<?php

namespace App\Providers;

use App\Interfaces\NoticeRepository;
use App\Repositories\NoticeRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class NoticeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NoticeRepository::class, NoticeRepositoryImpl::class);
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
