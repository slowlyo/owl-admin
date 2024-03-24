<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

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
        return $this->service()->store(request()->all());
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
