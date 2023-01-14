<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Form;
use Slowlyo\SlowAdmin\Renderers\Operation;
use Slowlyo\SlowAdmin\Renderers\TableColumn;
use Slowlyo\SlowAdmin\Renderers\TextControl;
use Slowlyo\SlowAdmin\Services\AdminRoleService;
use Illuminate\Http\Resources\Json\JsonResource;
use Slowlyo\SlowAdmin\Renderers\TreeSelectControl;
use Slowlyo\SlowAdmin\Services\AdminPermissionService;

class AdminRoleController extends AdminController
{
    protected string $serviceName = AdminRoleService::class;

    protected string $queryPath = 'system/admin_roles';

    protected string $pageTitle;

    public function __construct()
    {
        $this->pageTitle = __('admin.admin_roles');

        parent::__construct();
    }

    public function index(): JsonResponse|JsonResource
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->list());
        }

        return $this->response()->success($this->list());
    }

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([
                $this->createButton(true),
                'bulkActions',
                amis('reload')->align('right'),
                amis('filter-toggler')->align('right'),
            ])
            ->filterTogglable(false)
            ->columns([
                TableColumn::make()->label('ID')->name('id')->sortable(true),
                TableColumn::make()->label(__('admin.admin_role.name'))->name('name'),
                TableColumn::make()->label(__('admin.admin_role.slug'))->name('slug')->type('tag'),
                TableColumn::make()->label(__('admin.created_at'))->name('created_at')->type('datetime')->sortable(true),
                TableColumn::make()->label(__('admin.updated_at'))->name('updated_at')->type('datetime')->sortable(true),
                Operation::make()->label(__('admin.actions'))->buttons([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->visibleOn('${slug != "administrator"}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            TextControl::make()->label(__('admin.admin_role.name'))->name('name')->required(true),
            TextControl::make()
                ->label(__('admin.admin_role.slug'))
                ->name('slug')
                ->description(__('admin.admin_role.slug_description'))
                ->required(true),
            TreeSelectControl::make()
                ->name('permissions')
                ->label(__('admin.admin_role.permissions'))
                ->multiple(true)
                ->options(AdminPermissionService::make()->getTree())
                ->searchable(true)
                ->labelField('name')
                ->valueField('id')
                ->autoCheckChildren(false)
                ->joinValues(false)
                ->extractValue(true),
        ]);
    }

    public function detail($id): Form
    {
        return $this->baseDetail($id)->body([]);
    }
}
