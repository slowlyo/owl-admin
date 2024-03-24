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
                amis()->TableColumn('title', __('admin.apis.title'))->searchable(),
                amis()->TableColumn('path', __('admin.apis.path'))->searchable(),
                amis()->TableColumn('template_title', __('admin.apis.template')),
                amis()->TableColumn('enabled', __('admin.apis.enabled'))->quickEdit(
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
            amis()->TextControl('title', __('admin.apis.title'))->required(),
            amis()->TextControl('path', __('admin.apis.path'))->required(),
            amis()->SwitchControl('enabled', __('admin.apis.enabled'))->value(1),
            amis()->SelectControl('template', __('admin.apis.template'))
                ->required()
                ->source('/dev_tools/api/templates'),
            amis()->ComboControl('args', __('admin.apis.args'))
                ->visibleOn('${template}')
                ->multiLine()
                ->strictMode(false)
                ->items([
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
