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
        return admin_trans('admin.api_templates.data_update');
    }

    public function handle()
    {
        $result = $this->service()->update(request($this->getArgs('primary_key', 'id')), request()->all());

        if ($result) {
            return Admin::response()
                ->successMessage(admin_trans('admin.successfully_message', ['attribute' => admin_trans('admin.save')]));
        }

        return Admin::response()->fail(admin_trans('admin.failed_message', ['attribute' => admin_trans('admin.save')]));
    }

    public function argsSchema()
    {
        return [
            amis()->SelectControl('model', admin_trans('admin.relationships.model'))
                ->required()
                ->menuTpl('${label} <span class="text-gray-300 pl-2">${table}</span>')
                ->source('/dev_tools/relation/model_options')
                ->searchable(),
            amis()->TextControl('primary_id', admin_trans('admin.code_generators.primary_key'))->value('id'),
        ];
    }

    protected function service()
    {
        $service = $this->blankService();

        $service->setModelName($this->getArgs('model'));

        return $service;
    }
}
