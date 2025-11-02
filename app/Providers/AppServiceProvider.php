<?php

namespace App\Providers;

use App\Interfaces\MovieInterface;
use App\Interfaces\PersonInterface;
use App\Interfaces\TagInterface;
use App\Repositories\MovieRepository;
use App\Repositories\PersonRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MovieInterface::class, MovieRepository::class);
        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(PersonInterface::class, PersonRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
