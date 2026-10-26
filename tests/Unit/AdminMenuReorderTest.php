<?php

namespace Slowlyo\OwlAdmin\Tests\Unit;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Support\Cores\Database;
use Slowlyo\OwlAdmin\Tests\TestCase;

class AdminMenuReorderTest extends TestCase
{
    /**
     * 验证配置了表前缀时，菜单拖拽排序能写入带 prefix 的真实表。
     */
    public function test_reorder_updates_rows_when_connection_has_table_prefix(): void
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
