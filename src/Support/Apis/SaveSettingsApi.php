<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

class SaveSettingsApi extends AdminBaseApi
{
    public string $method = 'post';

    public function getTitle()
    {
        return admin_trans('admin.api_templates.save_settings');
    }

    public function handle()
    {
        return settings()->adminSetMany(request()->all());
    }

    public function argsSchema()
    {
        return [
            amis()->Markdown()->value(admin_trans('admin.api_templates.save_settings_description')),
        ];
    }
}
