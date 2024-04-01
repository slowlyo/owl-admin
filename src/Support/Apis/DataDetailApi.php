<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;

/**
 * 数据详情
 */
class DataDetailApi extends AdminBaseApi
{
    public string $method = 'get';

    public function getTitle()
    {
        return __('admin.api_templates.data_detail');
    }

    public function handle()
    {
        $data = $this->service()->getDetail(request($this->getArgs('primary_key', 'id')));

        return Admin::response()->success($data);
    }

    public function argsSchema()
    {
        return [
            amis()->SelectControl('model', __('admin.relationships.model'))
                ->required()
                ->menuTpl('${label} <span class="text-gray-300 pl-2">${table}</span>')
                ->source('/dev_tools/relation/model_options')
                ->searchable(),
            amis()->TextControl('primary_id', __('admin.code_generators.primary_key'))->value('id'),
        ];
    }

    protected function service()
    {
        $service = $this->blankService();

        $service->setModelName($this->getArgs('model'));

        return $service;
    }
}
