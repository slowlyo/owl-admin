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
        return admin_trans('admin.api_templates.data_create');
    }

    public function handle()
    {
        $result = $this->service()->store(request()->all());

        if ($result) {
            return Admin::response()
                ->successMessage(admin_trans('admin.successfully_message', ['attribute' => admin_trans('admin.create')]));
        }

        return Admin::response()->fail(admin_trans('admin.failed_message', ['attribute' => admin_trans('admin.create')]));
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
