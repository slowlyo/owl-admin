<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Services\AdminRoleService;
use Slowlyo\OwlAdmin\Services\AdminPermissionService;

/**
 * @property AdminRoleService $service
 */
class AdminRoleController extends AdminController
{
    protected string $serviceName = AdminRoleService::class;

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->filterTogglable(false)
            ->columns([
                amisMake()->TableColumn()->label('ID')->name('id')->sortable(),
                amisMake()->TableColumn()->label(__('admin.admin_role.name'))->name('name'),
                amisMake()->TableColumn()->label(__('admin.admin_role.slug'))->name('slug')->type('tag'),
                amisMake()->TableColumn()
                    ->label(__('admin.created_at'))
                    ->name('created_at')
                    ->type('datetime')
                    ->sortable(true),
                amisMake()->TableColumn()
                    ->label(__('admin.updated_at'))
                    ->name('updated_at')
                    ->type('datetime')
                    ->sortable(true),
                amisMake()->Operation()->label(__('admin.actions'))->buttons([
                    $this->setPermission()->visibleOn('${slug != "administrator"}'),
                    $this->rowEditButton(true)->visibleOn('${slug != "administrator"}'),
                    $this->rowDeleteButton()->visibleOn('${slug != "administrator"}'),
                ]),
            ]);

        return $this->baseList($crud)->css([
            '.tree-full'                               => [
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
        return amisMake()->DrawerAction()->label(__('admin.admin_role.set_permissions'))
            ->icon('fa-solid fa-lock')
            ->level('link')->drawer(
                amisMake()->Drawer()->title(__('admin.admin_role.set_permissions'))->resizable()->closeOnOutside()->closeOnEsc()->body([
                    amisMake()
                        ->Form()
                        ->api(admin_url('system/admin_role_save_permissions'))
                        ->initApi($this->getEditGetDataPath())
                        ->mode('normal')
                        ->data(['id' => '${id}'])
                        ->body([
                            amisMake()->TreeControl()
                                ->name('permissions')
                                ->label()
                                ->multiple()
                                ->options($this->service->getMenuPermission())
                                ->searchable()
                                ->autoCheckChildren(false)
                                ->joinValues(false)
                                ->extractValue()
                                ->size('full')
                                ->className('h-full b-none')
                                ->inputClassName('h-full tree-full')
                                ->labelField('name')
                                ->valueField('tag'),
                        ]),
                ])
            );
    }

    public function savePermissions()
    {
        $result = $this->service->savePermissions(request('id'), request('permissions'));

        return $this->autoResponse($result, __('admin.save'));
    }


    public function form(): Form
    {
        return $this->baseForm()->body([
            amisMake()->TextControl()->label(__('admin.admin_role.name'))->name('name')->required(),
            amisMake()->TextControl()
                ->label(__('admin.admin_role.slug'))
                ->name('slug')
                ->description(__('admin.admin_role.slug_description'))
                ->required(),
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }
}
