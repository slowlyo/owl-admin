<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;

/**
 * 数据更新
 */
class DataUpdateApi extends AdminBaseApi
{
    public string $method = 'put';

    public function getTitle()
    {
        return __('admin.api_templates.data_update');
    }

    public function handle()
    {
        $result = $this->service()->update(request($this->getArgs('primary_key', 'id')), request()->all());

        if ($result) {
            return Admin::response()
                ->successMessage(__('admin.successfully_message', ['attribute' => __('admin.save')]));
        }

        return Admin::response()->fail(__('admin.failed_message', ['attribute' => __('admin.save')]));
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
