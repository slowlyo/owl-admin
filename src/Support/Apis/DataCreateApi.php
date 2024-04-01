<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;

/**
 * 数据新增
 */
class DataCreateApi extends AdminBaseApi
{
    public string $method = 'post';

    public function getTitle()
    {
        return __('admin.api_templates.data_create');
    }

    public function handle()
    {
        $result = $this->service()->store(request()->all());

        if ($result) {
            return Admin::response()
                ->successMessage(__('admin.successfully_message', ['attribute' => __('admin.create')]));
        }

        return Admin::response()->fail(__('admin.failed_message', ['attribute' => __('admin.create')]));
    }

    public function argsSchema()
    {
        return [
            amis()->SelectControl('model', __('admin.relationships.model'))
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
