<?php

namespace Slowlyo\SlowAdmin;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Slowlyo\SlowAdmin\Console\InstallCommand;
use Slowlyo\SlowAdmin\Console\PublishCommand;

class SlowAdminServiceProvider extends ServiceProvider
{
    protected array $routeMiddleware = [
        'admin.auth'       => Middleware\Authenticate::class,
        'admin.bootstrap'  => Middleware\Bootstrap::class,
        'admin.session'    => Middleware\Session::class,
        'admin.permission' => Middleware\Permission::class,
        'sanctum'          => Middleware\EnsureFrontendRequestsAreStateful::class,
        'substitute'       => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    protected array $middlewareGroups = [
        'admin' => [
            'admin.auth',
            'admin.bootstrap',
            'admin.session',
            'admin.permission',
            'sanctum',
            'substitute',
        ],
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->loadAdminAuthConfig();
        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'admin');
        $this->registerRouteMiddleware();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        if (file_exists($routes = admin_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'slow-admin');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                PublishCommand::class,
            ]);
            $this->publishes([__DIR__ . '/../admin-views/dist' => public_path('admin')], 'admin-assets');
            $this->publishes([__DIR__ . '/../lang' => lang_path()], 'admin-lang');
            $this->publishes([__DIR__ . '/../config/admin.php' => config_path('admin.php')], 'admin-config');
            $this->publishes([__DIR__ . '/../admin-views' => resource_path('admin-views')], 'admin-views');
        }
    }

    protected function loadAdminAuthConfig()
    {
        config(Arr::dot(config('admin.auth', []), 'auth.'));
    }

    protected function registerRouteMiddleware(): void
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
