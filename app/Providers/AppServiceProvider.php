<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\PhoneDirectoryRepository;
use App\Repository\PhoneDirectoryRepositoryInterface;
use Illuminate\Support\Facades\Schema;

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
        $this->app->bind(PhoneDirectoryRepositoryInterface::class,
            PhoneDirectoryRepository::class);
        Schema::defaultStringLength(191);
    }
}
