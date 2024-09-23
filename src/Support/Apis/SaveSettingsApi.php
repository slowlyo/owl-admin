<?php

namespace Slowlyo\OwlAdmin\Support\Apis;

class SaveSettingsApi extends AdminBaseApi
{
    public string $method = 'post';

    public function getTitle()
    {
        return '保存设置项';
    }

    public function handle()
    {
        return settings()->adminSetMany(request()->all());
    }

    public function argsSchema()
    {
        return [
            amis()->Markdown()->value('### 使用说明

- 接口请求方式为 `POST`
- 请求参数为数组格式 (将该api作为表单的提交api即可正常使用)

```JSON
{
    "site_name": "string",
    "name": "string",
    "age": 0
}
```'),
        ];
    }
}
