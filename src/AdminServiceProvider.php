<?php

namespace Slowlyo\OwlAdmin;

use Illuminate\Support\Arr;
use Laravel\Sanctum\Sanctum;
use Slowlyo\OwlAdmin\Extend\Manager;
use Illuminate\Support\ServiceProvider;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Slowlyo\OwlAdmin\Models\PersonalAccessToken;
use Slowlyo\OwlAdmin\Support\{Context, Cores\Menu, Cores\Asset, Cores\Module};

class AdminServiceProvider extends ServiceProvider
{
    protected array $commands = [
        Console\UpdateCommand::class,
        Console\InstallCommand::class,
        Console\PublishCommand::class,
        Console\GenRouteCommand::class,
        Console\CreateUserCommand::class,
        Console\GenCodeClearCommand::class,
        Console\ResetPasswordCommand::class,
        Console\Module\InitCommand::class,
    ];

    protected array $routeMiddleware = [
        'admin.auth'       => Middleware\Authenticate::class,
        'admin.bootstrap'  => Middleware\Bootstrap::class,
        'admin.permission' => Middleware\Permission::class,
        'sanctum'          => Middleware\EnsureFrontendRequestsAreStateful::class,
        'substitute'       => \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    protected array $middlewareGroups = [
        'admin' => [
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

        $this->registerModules();
        $this->registerExtensions();
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
        $this->loadBaseRoute();
        $this->bootExtensions();
        $this->loadRoutes();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->usePersonalAccessTokenModel();
    }

    protected function loadBaseRoute()
    {
        Admin::loadBaseRoute();
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
        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'admin');

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

    public function registerModules()
    {
        Admin::module()->register();
    }

    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Exception
     */
    public function registerExtensions()
    {
        Admin::extension()->register();
    }

    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface|\ReflectionException
     */
    public function bootExtensions()
    {
        Admin::extension()->boot();
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

    /**
     * @return void
     */
    protected function usePersonalAccessTokenModel(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
