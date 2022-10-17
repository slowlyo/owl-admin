<?php

namespace Slowlyo\SlowAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\SlowAdmin\Models\AdminMenu;

class AdminMenuService extends AdminService
{
    protected string $modelName = AdminMenu::class;

    public function getTree(): array
    {
        $list = $this->query()->orderByDesc('order')->get()->toArray();

        return array2tree($list);
    }

    public function parentIsChild($id, $parent_id): bool
    {
        $parent = $this->query()->find($parent_id);

        do {
            if ($parent->parent_id == $id) {
                return true;
            }
            // 如果没有parent 则为顶级菜单 退出循环
            $parent = $parent->parent;
        } while ($parent);

        return false;
    }

    public function update($primaryKey, $data): bool
    {
        $parent_id = Arr::get($data, 'parent_id');
        if ($parent_id != 0) {
            if ($this->parentIsChild($primaryKey, $parent_id)) {
                $this->setError('父级菜单不允许设置为当前子菜单');
                return false;
            }
        }

        return parent::update($primaryKey, $data);
    }
}
