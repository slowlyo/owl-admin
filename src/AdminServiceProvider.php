<?php

namespace Slowlyo\OwlAdmin;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Extend\Manager;
use Illuminate\Support\ServiceProvider;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Slowlyo\OwlAdmin\Support\{Cores\Menu, Cores\Asset, Cores\Module, Cores\Context};

class AdminServiceProvider extends ServiceProvider
{
    protected array $commands = [
        Console\CheckCommand::class,
        Console\UpdateCommand::class,
        Console\InstallCommand::class,
        Console\PublishCommand::class,
        Console\GenRouteCommand::class,
        Console\IdeHelperCommand::class,
        Console\CreateUserCommand::class,
        Console\ResetPasswordCommand::class,
        Console\Module\InitCommand::class,
        Console\Module\InitDbCommand::class,
    ];

    protected array $routeMiddleware = [
        'admin.autoSetLocale' => Middleware\AutoSetLocale::class,
        'admin.auth'          => Middleware\Authenticate::class,
        'admin.bootstrap'     => Middleware\Bootstrap::class,
        'admin.permission'    => Middleware\Permission::class,
        'sanctum'             => Middleware\EnsureFrontendRequestsAreStateful::class,
        'substitute'          => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    protected array $middlewareGroups = [
        'admin' => [
            'admin.autoSetLocale',
            'admin.auth',
            'admin.bootstrap',
            'admin.permission',
            'sanctum',
            'substitute',
        ],
    ];

    /**
     * Register any application services.
     *
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->loadAdminAuthConfig();
        $this->registerServices();

        Admin::module()->register();
        Admin::extension()->register();
        $this->registerRouteMiddleware();
        $this->loadViewsFrom(public_path('admin-assets'), 'admin');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \ReflectionException
     */
    public function boot(): void
    {
        $this->ensureHttps();
        $this->registerPublishing();
        Admin::loadBaseRoute();
        Admin::extension()->boot();
        $this->loadRoutes();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'admin');

        Admin::boot();
    }

    protected function loadRoutes()
    {
        if (file_exists($adminRoutes = base_path('routes/admin.php'))) {
            $this->loadRoutesFrom($adminRoutes);
        }

        if (file_exists($routes = admin_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        }

        if ($modulePath = Admin::module()->allRoutePath()) {
            array_map(fn($path) => $this->loadRoutesFrom($path), $modulePath);
        }
    }

    protected function registerConfig()
    {
        $this->mergeConfigFrom(base_path('config/admin.php'), 'admin');
        
        base_path('config/admin.php')

        if ($moduleConfig = app(Module::class)->allConfigPath()) {
            foreach ($moduleConfig as $key => $path) {
                $this->mergeConfigFrom($path, $key);
            }
        }
    }

    protected function registerPublishing()
    {
        $this->commands($this->commands);

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../admin-views/dist' => public_path('admin-assets')], 'admin-assets');
            $this->publishes([__DIR__ . '/../lang' => lang_path()], 'admin-lang');
            $this->publishes([__DIR__ . '/../config/admin.php' => config_path('admin.php')], 'admin-config');
            $this->publishes([__DIR__ . '/../admin-views' => resource_path('admin-views')], 'admin-views');
        }
    }

    protected function ensureHttps()
    {
        if (Admin::config('admin.https')) {
            \URL::forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }
    }

    protected function loadAdminAuthConfig()
    {
        config(Arr::dot(Admin::config('admin.auth', []), 'auth.'));
    }

    public function registerServices()
    {
        $this->app->singleton('admin.module', Module::class);
        $this->app->singleton('admin.extend', Manager::class);
        $this->app->singleton('admin.context', Context::class);
        $this->app->singleton('admin.setting', fn() => settings());
        $this->app->singleton('admin.asset', Asset::class);
        $this->app->singleton('admin.menu', Menu::class);
    }

    /**
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function registerRouteMiddleware(): void
    {
        $router = $this->app->make('router');

        foreach ($this->routeMiddleware as $key => $middleware) {
            $router->aliasMiddleware($key, $middleware);
        }
        foreach ($this->middlewareGroups as $key => $middleware) {
            $router->middlewareGroup($key, $middleware);
        }
    }
}
