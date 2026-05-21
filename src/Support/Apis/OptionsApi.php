<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;

class OptionsApi extends AdminBaseApi
{
    public string $method = 'get';

    public function getTitle()
    {
        return admin_trans('admin.api_templates.options');
    }

    public function handle()
    {
        $data = $this->service()->query()->get([
            $this->getArgs('value_field') . ' as value',
            $this->getArgs('label_field') . ' as label',
        ]);

        return Admin::response()->success($data);
    }

    public function argsSchema()
    {
        return [
            amis()
                ->SelectControl('model', admin_trans('admin.relationships.model'))
                ->required()
                ->menuTpl('${label} <span class="text-gray-300 pl-2">${table}</span>')
                ->source('/dev_tools/relation/model_options')
                ->searchable(),
            amis()
                ->TextControl('value_field', admin_trans('admin.api_templates.value_field'))
                ->source('/dev_tools/relation/column_options?model=${model}'),
            amis()
                ->TextControl('label_field', admin_trans('admin.api_templates.label_field'))
                ->source('/dev_tools/relation/column_options?model=${model}'),
        ];
    }

    protected function service()
    {
        $service = $this->blankService();

        $service->setModelName($this->getArgs('model'));

        return $service;
    }
}
