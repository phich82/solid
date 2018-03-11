<?php

namespace App\Providers;

use App\Entities\BookFake;
use App\Entities\BookRepository;
use App\Services\PromotionService;
use Illuminate\Support\Facades\Redis;
use App\Entities\BookRepositoryCache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Contracts\BookRepositoryContract;
use App\Repositories\PromotionRepository;
use App\Services\PromotionServiceContract;
use App\Repositories\PromotionRepositoryContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind(BookRepositoryContract::class, BookRepository::class);
        $this->app->bind(BookRepositoryContract::class, function ($app) {
            $bookRepo = new BookRepository(new BookFake);
            //var_dump($this->app['cache.store']->tags('books'));
            //return new BookRepositoryCache($bookRepo, $this->app['cache.store']);
            return new BookRepositoryCache($bookRepo, new Redis);
        });

        $this->app->bind(PromotionRepositoryContract::class, PromotionRepository::class);
        $this->app->bind(PromotionServiceContract::class, PromotionService::class);
    }
}
