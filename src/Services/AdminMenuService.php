<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Models\AdminMenu;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method AdminMenu getModel()
 * @method AdminMenu|Builder query()
 */
class AdminMenuService extends AdminService
{
    protected string $modelName;

    public function __construct()
    {
        $this->modelName = Admin::adminMenuModel();
    }

    public function getTree(): array
    {
        $list = $this->query()->orderBy('order')->get()->toArray();

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
        $columns = $this->getTableColumns();

        $parent_id = Arr::get($data, 'parent_id');
        if ($parent_id != 0) {
            if ($this->parentIsChild($primaryKey, $parent_id)) {
                return $this->setError(__('admin.admin_menu.parent_id_not_allow'));
            }
        }

        $model = $this->query()->whereKey($primaryKey)->first();

        return $this->saveData($data, $columns, $model);
    }

    public function store($data): bool
    {
        $columns = $this->getTableColumns();

        $model = $this->getModel();

        return $this->saveData($data, $columns, $model);
    }

    public function changeHomePage($excludeId = 0)
    {
        $this->query()->when($excludeId, fn($query) => $query->where('id', '<>', $excludeId))->update(['is_home' => 0]);
    }

    public function list()
    {
        return ['items' => $this->getTree()];
    }

    /**
     * @param           $data
     * @param array     $columns
     * @param AdminMenu $model
     *
     * @return bool
     */
    protected function saveData($data, array $columns, AdminMenu $model): bool
    {
        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $v = $k == 'parent_id' ? intval($v) : $v;

            $model->setAttribute($k, $v);

            if ($k == 'is_home' && $v == 1) {
                $this->changeHomePage($model->getKey());
            }
        }

        return $model->save();
    }
}
