<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Facades\DB;
use Slowlyo\OwlAdmin\Renderers\Tag;
use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Services\AdminPermissionService;

/**
 * @property AdminPermissionService $service
 */
class AdminPermissionController extends AdminController
{
    protected string $serviceName = AdminPermissionService::class;

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->loadDataOnce()
            ->filterTogglable(false)
            ->footerToolbar([])
            ->headerToolbar([
                $this->createButton(true)->dialog(
                    amisMake()->Dialog()->title(__('admin.create'))->body($this->createForm())->size('lg')
                ),
                'bulkActions',
                amis('reload')->align('right'),
                amis('filter-toggler')->align('right'),
            ])
            ->itemCheckableOn('this.id')
            ->expandConfig([
                'expandAll' => true,
                'expand'    => 'first',
                'accordion' => false,
            ])
            ->columns([
                amisMake()->TableColumn('name', __('admin.admin_permission.name'))->width(160),
                amisMake()->TableColumn('slug', __('admin.admin_permission.slug'))->width(260),
                
                amisMake()->TableColumn('http_path', __('admin.admin_permission.http_path'))
                    ->type('each')
                    ->items(
                        Tag::make()->label('${item}')->className('max-w-xs my-1')
                    ),
                $this->rowActions([
                    $this->rowEditButton(true, 'lg')->visibleOn('${id!=0}'),
                    $this->rowDeleteButton()->visibleOn('${id!=0}'),
                ])->width(180),
            ]);

        return $this->baseList($crud);
    }

    public function createForm(): Form
    {
        return $this->baseForm()
            ->api($this->getStorePath())
            ->onEvent([])
            ->body([
                amisMake()->TreeSelectControl('menu', __('admin.menus'))
                    ->searchable()
                    ->showIcon(false)
                    ->options(AdminMenuService::make()->getTree())
                    ->labelField('title')
                    ->valueField('id')
                    ->autoCheckChildren(false)
                    ->required()
                    ->joinValues(false),

                amisMake()->CheckboxesControl('base_permission', '基础权限')
                    ->options(Admin::adminPermissionModel()::$base_permission)
                    ->joinValues(false)
                    ->extractValue(),

                amisMake()->TableControl('extra_permission', '额外权限')->addable()->removable()->copyable()
                    ->needConfirm(false)
                    ->columns([
                        amisMake()->TextControl('name', __('admin.admin_permission.name'))->required(),

                        amisMake()->TagControl('http_path', __('admin.admin_permission.http_path'))
                            ->extractValue()
                            ->joinValues(false)
                            ->placeholder('eg: post:/system/admin (请求方式:路径, 多条记录以逗号分割)'),

                    ])
            ]);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            amisMake()->TextControl('name', __('admin.admin_permission.name'))->required(),
            amisMake()->TextControl('slug', __('admin.admin_permission.slug'))->readOnly(),

            amisMake()->TagControl('http_path', __('admin.admin_permission.http_path'))
                ->extractValue()
                ->joinValues(false),
            amisMake()->TreeSelectControl('menu_id', __('admin.menus'))
                ->searchable()
                ->showIcon(false)
                ->options(AdminMenuService::make()->getTree())
                ->labelField('title')
                ->valueField('id')
                ->autoCheckChildren(false)
                ->joinValues(true),

        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }

    private function getHttpMethods(): array
    {
        return collect(Admin::adminPermissionModel()::$httpMethods)->map(fn ($method) => [
            'value' => $method,
            'label' => $method,
        ])->toArray();
    }
}
