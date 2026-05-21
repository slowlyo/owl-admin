<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

use Slowlyo\OwlAdmin\Admin;

class GetSettingsApi extends AdminBaseApi
{
    public string $method = 'get';

    public function getTitle()
    {
        return admin_trans('admin.api_templates.get_settings');
    }

    public function handle()
    {
        $data = match ($this->getArgs('mode')) {
            'all'  => settings()->all(),
            'part' => collect(settings()->all())->filter(fn($_, $k) => in_array($k, $this->getArgs('keys')))->toArray(),
            'one'  => settings()->get($this->getArgs('key')),
        };

        return Admin::response()->success($data);
    }

    public function argsSchema()
    {
        $allKeys = collect(settings()->all())->keys()->map(fn($i) => [
            'value' => $i,
            'label' => $i,
        ])->toArray();

        return [
            amis()->RadiosControl('mode', admin_trans('admin.api_templates.get_settings_mode'))->options([
                ['value' => 'all', 'label' => admin_trans('admin.api_templates.get_settings_all')],
                ['value' => 'part', 'label' => admin_trans('admin.api_templates.get_settings_part')],
                ['value' => 'one', 'label' => admin_trans('admin.api_templates.get_settings_one')],
            ])->selectFirst(),
            amis()->TextControl('key', admin_trans('admin.api_templates.setting_key'))->required()->visibleOn('${mode == "one"}')->options($allKeys),
            amis()->ArrayControl('keys', admin_trans('admin.api_templates.setting_key'))->required()->visibleOn('${mode == "part"}')->items([
                amis()->TextControl('value')->required()->options($allKeys),
            ]),
        ];
    }
}
