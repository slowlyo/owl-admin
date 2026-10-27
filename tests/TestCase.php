<?php

namespace Slowlyo\OwlAdmin\Tests;

use Laravel\Sanctum\SanctumServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Slowlyo\OwlAdmin\AdminServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * 注册包内 ServiceProvider，供 Testbench 启动最小 Laravel 环境。
     * Sanctum 负责注册 admin guard 使用的 sanctum 驱动，与宿主应用一致。
     */
    protected function getPackageProviders($app): array
    {
        return [
            AdminServiceProvider::class,
            SanctumServiceProvider::class,
        ];
    }

    /**
     * 使用带表前缀的内存 SQLite，模拟生产库 prefix 场景。
     */
    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'                  => 'sqlite',
            'database'                => ':memory:',
            'prefix'                  => 'owl_',
            'foreign_key_constraints' => true,
        ]);
        $app['config']->set('admin.database.connection', 'testing');
    }
}
