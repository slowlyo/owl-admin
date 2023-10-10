<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Renderers\Operation;
use Slowlyo\OwlAdmin\Services\AdminUserService;
use Slowlyo\OwlAdmin\Services\AdminRoleService;

/**
 * @property AdminUserService $service
 */
class AdminUserController extends AdminController
{
    protected string $serviceName = AdminUserService::class;

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([
                $this->createButton(true)->permission('9cd1e656-5563-47a4-9238-28216746d2e8'),
                ...$this->baseHeaderToolBar(),
            ])
            ->filter($this->baseFilter()->body(
                amisMake()->TextControl('keyword', __('admin.keyword'))
                    ->size('md')
                    ->placeholder(__('admin.admin_user.search_username'))
            ))
            ->columns([
                amisMake()->TableColumn('id', 'ID')->sortable(),
                amisMake()->TableColumn('avatar', __('admin.admin_user.avatar'))->type('avatar')->src('${avatar}'),
                amisMake()->TableColumn('username', __('admin.username')),
                amisMake()->TableColumn('name', __('admin.admin_user.name')),
                amisMake()->TableColumn('roles', __('admin.admin_user.roles'))->type('each')->items(
                    amisMake()->Tag()->label('${name}')->className('my-1')
                ),
                amisMake()->TableColumn('created_at', __('admin.created_at'))->type('datetime')->sortable(true),
                Operation::make()->label(__('admin.actions'))->buttons([
                    $this->rowEditButton(true)->permission('5164d51e-ee69-4fe0-99f4-87f00b33d057'),
                    $this->rowDeleteButton()->visibleOn('${id != 1}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            amisMake()->ImageControl('avatar', __('admin.admin_user.avatar'))->receiver($this->uploadImagePath()),
            amisMake()->TextControl('username', __('admin.username'))->required(),
            amisMake()->TextControl('name', __('admin.admin_user.name'))->required(),
            amisMake()->TextControl('password', __('admin.password'))->type('input-password'),
            amisMake()->TextControl('confirm_password', __('admin.confirm_password'))->type('input-password'),
            amisMake()->SelectControl('roles', __('admin.admin_user.roles'))
                ->searchable()
                ->multiple()
                ->labelField('name')
                ->valueField('id')
                ->joinValues(false)
                ->extractValue()
                ->options(AdminRoleService::make()->query()->get(['id', 'name'])),
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }
}
