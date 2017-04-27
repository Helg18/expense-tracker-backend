<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategory;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\Transaction\EloquentTrasaction;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->singleton(CategoryRepository::class, EloquentCategory::class);
         $this->app->singleton(TransactionRepository::class, EloquentTransaction::class);    }
}
