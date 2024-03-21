<?php

namespace Slowlyo\OwlAdmin\Services;

use Slowlyo\OwlAdmin\Models\AdminPage;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method AdminPage getModel()
 * @method AdminPage|Builder query()
 */
class AdminPageService extends AdminService
{
    protected string $modelName = AdminPage::class;

    public string $cacheKeyPrefix = 'admin_page:';

    public function saving(&$data, $primaryKey = '')
    {
        $data['schema'] = data_get($data, 'page.schema');
        admin_abort_if(blank($data['schema']), '页面结构不可为空');
        unset($data['page']);

        $exists = $this->query()
            ->where('sign', $data['sign'])
            ->when($primaryKey, fn($q) => $q->where('id', '<>', $primaryKey))
            ->exists();

        admin_abort_if($exists, '页面标识已存在');
    }

    public function saved($model, $isEdit = false)
    {
        if ($isEdit) {
            cache()->delete($this->cacheKeyPrefix . $model->sign);
        }
    }

    public function delete(string $ids)
    {
        $this->query()->whereIn('id', explode(',', $ids))->get()->map(function ($item) {
            cache()->delete($this->cacheKeyPrefix . $item->sign);
        });


        return parent::delete($ids);
    }

    public function getEditData($id)
    {
        $data = parent::getEditData($id);

        $data->setAttribute('page', ['schema' => $data->schema]);
        $data->setAttribute('schema', '');

        return $data;
    }

    /**
     * 获取页面结构
     *
     * @param $sign
     *
     * @return mixed
     */
    public function get($sign)
    {
        return cache()->rememberForever($this->cacheKeyPrefix . $sign, function () use ($sign) {
            return $this->query()->where('sign', $sign)->value('schema');
        });
    }
}
