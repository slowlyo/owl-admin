<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
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
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->filter($this->baseFilter()->body(
                amis()->TextControl('keyword', __('admin.keyword'))
                    ->size('md')
                    ->placeholder(__('admin.admin_user.search_username'))
            ))
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('avatar', __('admin.admin_user.avatar'))->type('avatar')->src('${avatar}'),
                amis()->TableColumn('username', __('admin.username')),
                amis()->TableColumn('name', __('admin.admin_user.name')),
                amis()->TableColumn('roles', __('admin.admin_user.roles'))->type('each')->items(
                    amis()->Tag()->label('${name}')->className('my-1')
                ),
                amis()->TableColumn('enabled', __('admin.extensions.card.status'))->quickEdit(
                    amis()->SwitchControl()->mode('inline')->disabledOn('${id == 1}')->saveImmediately(true)
                ),
                amis()->TableColumn('created_at', __('admin.created_at'))->type('datetime')->sortable(true),
                $this->rowActions([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->hiddenOn('${administrator}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            amis()->ImageControl('avatar', __('admin.admin_user.avatar'))->receiver($this->uploadImagePath()),
            amis()->TextControl('username', __('admin.username'))->required(),
            amis()->TextControl('name', __('admin.admin_user.name'))->required(),
            amis()->TextControl('password', __('admin.password'))->type('input-password'),
            amis()->TextControl('confirm_password', __('admin.confirm_password'))->type('input-password'),
            amis()->SelectControl('roles', __('admin.admin_user.roles'))
                ->searchable()
                ->multiple()
                ->labelField('name')
                ->valueField('id')
                ->joinValues(false)
                ->extractValue()
                ->options(AdminRoleService::make()->query()->get(['id', 'name'])),
            amis()->SwitchControl('enabled', __('admin.extensions.card.status'))
                ->onText(__('admin.extensions.enable'))
                ->offText(__('admin.extensions.disable'))
                ->disabledOn('${id == 1}')
                ->value(1),
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }
}
