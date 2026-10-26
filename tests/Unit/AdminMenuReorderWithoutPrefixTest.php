<?php

namespace Slowlyo\OwlAdmin\Tests\Unit;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Support\Cores\Database;
use Slowlyo\OwlAdmin\Tests\TestCase;

class AdminMenuReorderWithoutPrefixTest extends TestCase
{
    /**
     * 无表前缀时 testing 连接与生产默认行为一致。
     */
    protected function defineEnvironment($app): void
    {
        parent::defineEnvironment($app);

        $app['config']->set('database.connections.testing.prefix', '');
    }

    /**
     * 验证未配置 prefix 时 reorder 仍能正确更新 custom_order。
     */
    public function test_reorder_updates_rows_when_connection_has_no_table_prefix(): void
    {
        Database::make()->up();

        $menuModel = Admin::adminMenuModel();
        $now       = now();

        $menuModel::query()->insert([
            [
                'id'           => 1,
                'parent_id'    => 0,
                'custom_order' => 99,
                'title'        => 'menu-a',
                'url'          => '/menu-a',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'id'           => 2,
                'parent_id'    => 0,
                'custom_order' => 99,
                'title'        => 'menu-b',
                'url'          => '/menu-b',
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ]);

        $service = new AdminMenuService();
        $result  = $service->reorder('2,1');

        $this->assertNotFalse($result);
        $this->assertSame(0, (int) $menuModel::query()->find(2)->custom_order);
        $this->assertSame(10, (int) $menuModel::query()->find(1)->custom_order);
    }
}
