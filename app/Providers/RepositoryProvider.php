<?php

namespace App\Providers;

use App\Repositories\ImageRepository;
use App\Repositories\Interfaces\IImageRepository;
use App\Repositories\Interfaces\IPermissionRepository;
use App\Repositories\Interfaces\ITagRepository;
use App\Repositories\Interfaces\ITodoListRepository;
use App\Repositories\Interfaces\ITodoRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\TagRepository;
use App\Repositories\TodoListRepository;
use App\Repositories\TodoRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ITodoListRepository::class, TodoListRepository::class);
        $this->app->bind(ITodoRepository::class, TodoRepository::class);
        $this->app->bind(IImageRepository::class, ImageRepository::class);
        $this->app->bind(ITagRepository::class, TagRepository::class);
        $this->app->bind(IPermissionRepository::class, PermissionRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
