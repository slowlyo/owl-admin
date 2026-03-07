<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Services\AdminService;

/**
 * 删除数据
 */
class DataDeleteApi extends AdminBaseApi
{
    public string $method = 'delete';

    /**
     * 获取接口标题
     *
     * @return string
     */
    public function getTitle()
    {
        return admin_trans('admin.api_templates.data_delete');
    }

    /**
     * 删除数据
     *
     * @return mixed
     */
    public function handle()
    {
        $result = $this->service()->delete(request($this->getArgs('primary_key', 'ids')));

        // 删除成功时，返回统一成功消息。
        if ($result) {
            return Admin::response()
                ->successMessage(admin_trans('admin.successfully_message', ['attribute' => admin_trans('admin.delete')]));
        }

        return Admin::response()->fail(admin_trans('admin.failed_message', ['attribute' => admin_trans('admin.delete')]));
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
            amis()->TextControl('primary_key', admin_trans('admin.code_generators.primary_key'))->value('ids'),
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
