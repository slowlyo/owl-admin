<?php

namespace Slowlyo\SlowAdmin;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Slowlyo\SlowAdmin\Console\InstallCommand;

class SlowAdminServiceProvider extends ServiceProvider
{
    protected array $routeMiddleware = [
        'admin.auth'       => Middleware\Authenticate::class,
        'admin.bootstrap'  => Middleware\Bootstrap::class,
        'admin.session'    => Middleware\Session::class,
        'admin.permission' => Middleware\Permission::class,
        'sanctum'          => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
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
            ]);
            $this->publishes([__DIR__ . '/../public' => public_path('vendor/admin')], 'public');
            $this->publishes([__DIR__ . '/../lang' => lang_path()], 'lang');
            $this->publishes([__DIR__ . '/../config/admin.php' => config_path('admin.php')]);
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
