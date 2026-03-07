<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Services\AdminService;

/**
 * 数据状态切换接口
 */
class DataToggleApi extends AdminBaseApi
{
    public string $method = 'put';

    /**
     * 获取接口标题
     *
     * @return string
     */
    public function getTitle()
    {
        return admin_trans('admin.api_templates.data_toggle');
    }

    /**
     * 切换字段值
     *
     * @return mixed
     */
    public function handle()
    {
        $field = $this->getArgs('field');
        $primaryKey = $this->getArgs('primary_key', 'id');
        $primaryValue = request($primaryKey);
        $service = $this->service();

        admin_abort_if(blank($field), '请配置切换字段');
        admin_abort_if(blank($primaryValue), '缺少主键参数');
        admin_abort_if(!$service->hasColumn($field), '切换字段不存在');

        $model = $service->query()->whereKey($primaryValue)->first();

        admin_abort_if(!$model, '数据不存在');

        $trueValue = $this->getArgs('true_value', 1);
        $falseValue = $this->getArgs('false_value', 0);

        // 当前值等于开启值时，切换为关闭值。
        if ((string) $model->getAttribute($field) === (string) $trueValue) {
            $nextValue = $falseValue;
        } else {
            // 当前值不是开启值时，切换为开启值。
            $nextValue = $trueValue;
        }

        $result = $service->update($primaryValue, [$field => $nextValue]);

        // 更新成功时，返回最新字段值。
        if ($result) {
            return Admin::response()->success([
                'value' => $nextValue,
                $primaryKey => $primaryValue,
            ]);
        }

        return Admin::response()->fail(admin_trans('admin.failed_message', ['attribute' => admin_trans('admin.save')]));
    }

    /**
     * 获取参数配置表单
     *
     * @return array
     */
    public function argsSchema()
    {
        return [
            amis()->SelectControl('model', admin_trans('admin.relationships.model'))
                ->required()
                ->menuTpl('${label} <span class="text-gray-300 pl-2">${table}</span>')
                ->source('/dev_tools/relation/model_options')
                ->searchable(),
            amis()->TextControl('primary_key', admin_trans('admin.code_generators.primary_key'))->value('id'),
            amis()->TextControl('field', '切换字段')
                ->required()
                ->source('/dev_tools/relation/column_options?model=${model}'),
            amis()->TextControl('true_value', '开启值')->value(1),
            amis()->TextControl('false_value', '关闭值')->value(0),
        ];
    }

    /**
     * 创建通用数据服务
     *
     * @return AdminService
     */
    protected function service()
    {
        $service = $this->blankService();

        $service->setModelName($this->getArgs('model'));

        return $service;
    }
}
