<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;

/**
 * 数据列表接口
 */
class DataListApi extends AdminBaseApi
{
    public string $method = 'get';

    public function getTitle()
    {
        return admin_trans('admin.api_templates.data_list');
    }

    public function handle()
    {
        return Admin::response()->success($this->service()->list());
    }

    public function argsSchema()
    {
        return [
            amis()->SelectControl('model', admin_trans('admin.relationships.model'))
                ->required()
                ->menuTpl('${label} <span class="text-gray-300 pl-2">${table}</span>')
                ->source('/dev_tools/relation/model_options')
                ->searchable(),
        ];
    }

    protected function service()
    {
        $service = $this->blankService();

        $service->setModelName($this->getArgs('model'));

        return $service;
    }
}
