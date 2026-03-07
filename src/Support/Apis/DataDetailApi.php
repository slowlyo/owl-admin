<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;

/**
 * 数据详情
 */
class DataDetailApi extends AdminBaseApi
{
    public string $method = 'get';

    /**
     * 获取接口标题
     *
     * @return string
     */
    public function getTitle()
    {
        return admin_trans('admin.api_templates.data_detail');
    }

    /**
     * 获取详情数据
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->service()->getDetail(request($this->getArgs('primary_key', 'id')));

        return Admin::response()->success($data);
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
