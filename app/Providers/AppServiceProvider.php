<?php

namespace App\Providers;

use App\Repositories\UserRoleCachedRepository;
use App\Repositories\UserRoleDatabaseRepository;
use App\Repositories\UserRoleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRoleCachedRepository::class, function(){
            return new UserRoleCachedRepository(
                config('app_service.cached_repository_cache_time'),
                config('app_service.cached_repository_cache_prefix'),
                new UserRoleDatabaseRepository()
            );
        });

        $this->app->bind(UserRoleRepositoryInterface::class, function(){
            $userRoleRepositoryConfig = config('app_service.user_role_repository');
            $class = 'App\Repositories\UserRole' . ucfirst($userRoleRepositoryConfig) . 'Repository';

            return $this->app->make($class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
