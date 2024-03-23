<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Services\AdminApiService;
use Slowlyo\OwlAdmin\Support\Apis\AdminBaseApi;
use Slowlyo\OwlAdmin\Controllers\AdminController;

/**
 * @property AdminApiService $service
 */
class ApiController extends AdminController
{
    protected string $serviceName = AdminApiService::class;

    public function list()
    {
        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->headerToolbar([
                $this->createButton(true, 'lg'),
                ...$this->baseHeaderToolBar(),
            ])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('title', '名称')->searchable(),
                amis()->TableColumn('path', '路径')->searchable(),
                amis()->TableColumn('template_title', '模板'),
                amis()->TableColumn('enabled', '是否启用')->quickEdit(
                    amis()->SwitchControl()->mode('inline')->saveImmediately(true)
                ),
                amis()->TableColumn('updated_at', __('admin.updated_at'))->type('datetime')->sortable(true),
                $this->rowActions([
                    $this->rowEditButton(true, 'lg'),
                    $this->rowDeleteButton(),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form()
    {
        return $this->baseForm()->body([
            amis()->TextControl('title', '名称')->required(),
            amis()->TextControl('path', '路径')->required(),
            amis()->SwitchControl('enabled', '是否启用')->value(1),
            amis()->SelectControl('template', '模板')->required()->source('/dev_tools/api/templates'),
            amis()->ComboControl('args', '参数')->visibleOn('${template}')->multiLine()->strictMode(false)->items([
                amis()->Service()->initFetch()->schemaApi('get:/dev_tools/api/args_schema?template=${template}'),
            ]),
        ]);
    }


    public function detail($id)
    {
        return $this->baseDetail()->body([]);
    }

    public function template()
    {
        $apis = collect(Admin::context()->apis)
            ->filter(fn($item) => (new \ReflectionClass($item))->isSubclassOf(AdminBaseApi::class))
            ->map(fn($item) => [
                'label' => app($item)->getTitle(),
                'value' => $item,
            ]);

        return $this->response()->success($apis);
    }

    public function argsSchema()
    {
        $schema = app(request('template'))->argsSchema();

        if (blank($schema)) {
            $schema = null;
        }

        return $this->response()->success($schema);
    }
}
