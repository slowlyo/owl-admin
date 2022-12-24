<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Tag;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Form;
use Slowlyo\SlowAdmin\Renderers\Operation;
use Slowlyo\SlowAdmin\Renderers\TextControl;
use Slowlyo\SlowAdmin\Renderers\TableColumn;
use Slowlyo\SlowAdmin\Renderers\ImageControl;
use Slowlyo\SlowAdmin\Renderers\SelectControl;
use Slowlyo\SlowAdmin\Services\AdminUserService;
use Slowlyo\SlowAdmin\Services\AdminRoleService;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminUserController extends AdminController
{
    protected string $serviceName = AdminUserService::class;

    protected string $queryPath = 'admin_users';

    protected string $pageTitle;

    public function __construct()
    {
        $this->pageTitle = __('admin.admin_users');

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
            ->filter($this->baseFilter()->body(
                TextControl::make()
                    ->name('keyword')
                    ->label(__('admin.keyword'))
                    ->size('md')
                    ->placeholder(__('admin.admin_user.search_username'))
            ))
            ->columns([
                TableColumn::make()->label('ID')->name('id')->sortable(true),
                TableColumn::make()->label(__('admin.admin_user.avatar'))->name('avatar')->type('avatar')->src('${avatar}'),
                TableColumn::make()->label(__('admin.username'))->name('username'),
                TableColumn::make()->label(__('admin.admin_user.name'))->name('name'),
                TableColumn::make()->label(__('admin.admin_user.roles'))->name('roles')->type('each')->items(
                    Tag::make()->label('${name}')->className('my-1')
                ),
                TableColumn::make()->label(__('admin.created_at'))->name('created_at')->type('datetime')->sortable(true),
                Operation::make()->label(__('admin.actions'))->buttons([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->visibleOn('${id != 1}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            ImageControl::make()
                ->label(__('admin.admin_user.avatar'))
                ->name('avatar')
                ->receiver($this->uploadImagePath()),
            TextControl::make()->label(__('admin.username'))->name('username')->required(true),
            TextControl::make()->label(__('admin.admin_user.name'))->name('name')->required(true),
            TextControl::make()->type('input-password')->label(__('admin.password'))->name('password'),
            TextControl::make()
                ->type('input-password')
                ->label(__('admin.confirm_password'))
                ->name('confirm_password'),
            SelectControl::make()
                ->name('roles')
                ->label(__('admin.admin_user.roles'))
                ->searchable(true)
                ->multiple(true)
                ->labelField('name')
                ->valueField('id')
                ->joinValues(false)
                ->extractValue(true)
                ->options(AdminRoleService::make()->query()->get(['id', 'name'])),
        ]);
    }

    public function detail($id): Form
    {
        return $this->baseDetail($id)->body([]);
    }
}
