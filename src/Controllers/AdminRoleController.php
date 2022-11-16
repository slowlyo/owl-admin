<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Column;
use Slowlyo\SlowAdmin\Renderers\Form\Form;
use Slowlyo\SlowAdmin\Renderers\Form\InputText;
use Slowlyo\SlowAdmin\Services\AdminRoleService;
use Slowlyo\SlowAdmin\Renderers\Form\TreeSelect;
use Illuminate\Http\Resources\Json\JsonResource;
use Slowlyo\SlowAdmin\Services\AdminPermissionService;

class AdminRoleController extends AdminController
{
    protected string $serviceName = AdminRoleService::class;

    protected string $queryPath = 'admin_roles';

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
                Column::make()->label('ID')->name('id')->sortable(true),
                Column::make()->label(__('admin.admin_role.name'))->name('name'),
                Column::make()->label(__('admin.admin_role.slug'))->name('slug')->type('tag'),
                Column::make()->label(__('admin.created_at'))->name('created_at')->type('datetime')->sortable(true),
                Column::make()->label(__('admin.updated_at'))->name('updated_at')->type('datetime')->sortable(true),
                amis('operation')->label(__('admin.actions'))->buttons([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->visibleOn('${slug != "administrator"}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            InputText::make()->label(__('admin.admin_role.name'))->name('name')->required(true),
            InputText::make()
                ->label(__('admin.admin_role.slug'))
                ->name('slug')
                ->description(__('admin.admin_role.slug_description'))
                ->required(true),
            TreeSelect::make()
                ->name('permissions')
                ->label(__('admin.admin_role.permissions'))
                ->searchable(true)
                ->multiple(true)
                ->options(AdminPermissionService::make()->getTree())
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
