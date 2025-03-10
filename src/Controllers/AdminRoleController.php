<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Services\AdminRoleService;
use Slowlyo\OwlAdmin\Services\AdminPermissionService;

/**
 * @property AdminRoleService $service
 */
class AdminRoleController extends AdminController
{
    protected string $serviceName = AdminRoleService::class;

    public function list()
    {
        $crud = $this
            ->baseCRUD()
            ->headerToolbar([
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->filterTogglable(true)
            ->filter($this->baseFilter()->body([
                amis()->TextControl('name', admin_trans('admin.admin_role.name'))
                    ->size('md')
                    ->clearable()
                    ->placeholder(admin_trans('admin.admin_role.name')),
                amis()->TextControl('slug', admin_trans('admin.admin_role.slug'))
                    ->size('md')
                    ->clearable()
                    ->placeholder(admin_trans('admin.admin_role.slug')),
                amis()->DateRangeControl('created_at', admin_trans('admin.created_at'))
                    ->clearable()
                    ->format('YYYY-MM-DD')
                    ->placeholder(admin_trans('admin.created_at')),
            ]))
            ->columns([
                amis()->TableColumn()->label('ID')->name('id')->sortable(),
                amis()->TableColumn()->label(admin_trans('admin.admin_role.name'))->name('name'),
                amis()->TableColumn()->label(admin_trans('admin.admin_role.slug'))->name('slug')->type('tag'),
                amis()
                    ->TableColumn()
                    ->label(admin_trans('admin.created_at'))
                    ->name('created_at')
                    ->type('datetime')
                    ->sortable(),
                amis()
                    ->TableColumn()
                    ->label(admin_trans('admin.updated_at'))
                    ->name('updated_at')
                    ->type('datetime')
                    ->sortable(),
                $this->rowActions([
                    $this->setPermission(),
                    $this->rowEditButton(true),
                    $this->rowDeleteButton(),
                ]),
            ]);

        return $this->baseList($crud)->css([
            '.tree-full'                   => [
                'overflow' => 'hidden !important',
            ],
            '.cxd-TreeControl > .cxd-Tree' => [
                'height'     => '100% !important',
                'max-height' => '100% !important',
            ],
        ]);
    }

    protected function setPermission()
    {
        return amis()
            ->DrawerAction()
            ->label(admin_trans('admin.admin_role.set_permissions'))
            ->level('link')
            ->drawer(
                amis()
                    ->Drawer()
                    ->title(admin_trans('admin.admin_role.set_permissions'))
                    ->resizable()
                    ->closeOnOutside()
                    ->closeOnEsc()
                    ->body([
                        amis()
                            ->Form()
                            ->api(admin_url('system/admin_roles/save_permissions'))
                            ->initApi($this->getEditGetDataPath())
                            ->mode('normal')
                            ->data(['id' => '${id}'])
                            ->body([
                                amis()
                                    ->TreeControl()
                                    ->name('permissions')
                                    ->label()
                                    ->multiple()
                                    ->heightAuto()
                                    ->options(AdminPermissionService::make()->getTree())
                                    ->searchable()
                                    ->cascade()
                                    ->joinValues(false)
                                    ->extractValue()
                                    ->size('full')
                                    ->className('h-full b-none')
                                    ->inputClassName('h-full tree-full')
                                    ->labelField('name')
                                    ->valueField('id'),
                            ]),
                    ])
            );
    }

    public function savePermissions()
    {
        $result = $this->service->savePermissions(request('id'), request('permissions'));

        return $this->autoResponse($result, admin_trans('admin.save'));
    }

    public function form()
    {
        return $this->baseForm()->body([
            amis()->TextControl()->label(admin_trans('admin.admin_role.name'))->name('name')->required(),
            amis()
                ->TextControl()
                ->label(admin_trans('admin.admin_role.slug'))
                ->name('slug')
                ->description(admin_trans('admin.admin_role.slug_description'))
                ->required(),
        ]);
    }

    public function detail()
    {
        return $this->baseDetail()->body([]);
    }
}
