<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Services\AdminUserService;

/**
 * @property AdminUserService $service
 */
class AdminUserController extends AdminController
{
    protected string $serviceName = AdminUserService::class;

    public function list()
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->filter($this->baseFilter()->body(
                amis()->TextControl('keyword', admin_trans('admin.keyword'))
                    ->size('md')
                    ->placeholder(admin_trans('admin.admin_user.search_username'))
            ))
            ->itemCheckableOn('${id != 1}')
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('avatar', admin_trans('admin.admin_user.avatar'))->type('avatar')->src('${avatar}'),
                amis()->TableColumn('username', admin_trans('admin.username')),
                amis()->TableColumn('name', admin_trans('admin.admin_user.name')),
                amis()->TableColumn('roles', admin_trans('admin.admin_user.roles'))->type('each')->items(
                    amis()->Tag()->label('${name}')->className('my-1')
                ),
                amis()->TableColumn('enabled', admin_trans('admin.extensions.card.status'))->quickEdit(
                    amis()->SwitchControl()->mode('inline')->disabledOn('${id == 1}')->saveImmediately()
                ),
                amis()->TableColumn('created_at', admin_trans('admin.created_at'))->type('datetime')->sortable(),
                $this->rowActions([
                    $this->rowEditButton(true)
                        ->hiddenOn('${administrator && ' . !admin_user()->isAdministrator() . '}'),
                    $this->rowDeleteButton()->hiddenOn('${id == 1}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form()
    {
        return $this->baseForm()->body([
            amis()->ImageControl('avatar', admin_trans('admin.admin_user.avatar'))->receiver($this->uploadImagePath()),
            amis()->TextControl('username', admin_trans('admin.username'))->required(),
            amis()->TextControl('name', admin_trans('admin.admin_user.name'))->required(),
            amis()->TextControl('password', admin_trans('admin.password'))->type('input-password'),
            amis()->TextControl('confirm_password', admin_trans('admin.confirm_password'))->type('input-password'),
            amis()->SelectControl('roles', admin_trans('admin.admin_user.roles'))
                ->searchable()
                ->multiple()
                ->labelField('name')
                ->valueField('id')
                ->joinValues(false)
                ->extractValue()
                ->disabledOn('${id == 1}')
                ->options($this->service->roleOptions()),
            amis()->SwitchControl('enabled', admin_trans('admin.extensions.card.status'))
                ->onText(admin_trans('admin.extensions.enable'))
                ->offText(admin_trans('admin.extensions.disable'))
                ->disabledOn('${id == 1}')
                ->value(1),
        ]);
    }

    public function detail()
    {
        return $this->baseDetail()->body([]);
    }
}
