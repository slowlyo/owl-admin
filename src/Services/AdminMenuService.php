<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Facades\DB;
use Slowlyo\OwlAdmin\Models\AdminMenu;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method AdminMenu getModel()
 * @method AdminMenu|Builder query()
 */
class AdminMenuService extends AdminService
{
    public function __construct()
    {
        parent::__construct();

        $this->modelName = Admin::adminMenuModel();
    }

    public function getTree()
    {
        $title = request('title');
        $url = request('url');

        $list = $this->query()
            ->when($title, fn($query) => $query->where('title', 'like', '%' . $title . '%'))
            ->when($url, fn($query) => $query->where('url', 'like', '%' . $url . '%'))
            ->orderBy('custom_order')
            ->get()
            ->toArray();

        return array2tree($list);
    }

    public function parentIsChild($id, $parent_id)
    {
        if ($id == $parent_id) {
            return true;
        }

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

    public function update($primaryKey, $data)
    {
        $columns = $this->getTableColumns();

        $parent_id = Arr::get($data, 'parent_id') ?: 0;
        if ($parent_id != 0) {
            admin_abort_if($this->parentIsChild($primaryKey, $parent_id), admin_trans('admin.admin_menu.parent_id_not_allow'));
        }

        $model = $this->query()->whereKey($primaryKey)->first();

        $data['id'] = $primaryKey;

        return $this->saveData($data, $columns, $model);
    }

    public function store($data)
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
    protected function saveData($data, array $columns, AdminMenu $model)
    {
        $urlExists = $this->query()
            ->where('url', data_get($data, 'url'))
            ->when(data_get($data, 'id'), fn($q) => $q->where('id', '<>', data_get($data, 'id')))
            ->exists();

        admin_abort_if($urlExists, admin_trans('admin.admin_menu.url_exists'));

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

    /**
     * 重新排序菜单
     *
     * @param $ids
     *
     * @return false|int
     */
    public function reorder($ids)
    {
        if (blank($ids)) {
            return false;
        }

        $ids = json_decode('[' . str_replace('[', ',[', $ids) . ']');

        $list = collect($this->refreshOrder($ids))->transform(fn($i) => $i * 10)->all();

        $sql = 'update ' . $this->getModel()->getTable() . ' set "custom_order" = case id ';

        $params = [];
        foreach ($list as $k => $v) {
            $params[] = $k;
            $params[] = $v;
            $sql .= " when ? then ? ";
        }

        return DB::update($sql . ' else "custom_order" end', $params);
    }

    public function refreshOrder($list)
    {
        $result = collect($list)->filter(fn($i) => !is_array($i))->values()->flip()->toArray();

        collect($list)->filter(fn($i) => is_array($i))->each(function ($item) use (&$result) {
            $result = $this->refreshOrder($item) + $result;
        });

        return $result;
    }
}
