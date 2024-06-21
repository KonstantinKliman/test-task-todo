<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\Interfaces\IAuthService;
use App\Services\Interfaces\ITagService;
use App\Services\Interfaces\ITodoListService;
use App\Services\Interfaces\ITodoService;
use App\Services\TagService;
use App\Services\TodoListService;
use App\Services\TodoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(ITodoListService::class, TodoListService::class);
        $this->app->bind(ITodoService::class, TodoService::class);
        $this->app->bind(ITagService::class, TagService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
