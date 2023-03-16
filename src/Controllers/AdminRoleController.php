<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Services\AdminRoleService;
use Slowlyo\OwlAdmin\Services\AdminPermissionService;

class AdminRoleController extends AdminController
{
    protected string $serviceName = AdminRoleService::class;

    protected string $pageTitle;

    public function __construct()
    {
        $this->pageTitle = __('admin.admin_roles');

        parent::__construct();
    }

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->filterTogglable(false)
            ->columns([
                amisMake()->TableColumn()->label('ID')->name('id')->sortable(true),
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
                    $this->setPermission(),
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->visibleOn('${slug != "administrator"}'),
                ]),
            ]);

        return $this->baseList($crud)->css([
            '.tree-full'                               => [
                'overflow' => 'hidden !important',
            ],
            '.amis-scope .cxd-TreeControl > .cxd-Tree' => [
                'height'     => '100% !important',
                'max-height' => '100% !important',
            ],
        ]);
    }

    protected function setPermission()
    {
        return amisMake()->DrawerAction()->label('设置权限')->icon('fa-solid fa-gear')->level('link')->drawer(
            amisMake()->Drawer()->title('设置权限')->resizable(true)->closeOnOutside(true)->closeOnEsc(true)->body([
                amisMake()
                    ->Form()
                    ->api(admin_url('system/admin_role_save_permissions'))
                    ->initApi($this->getEditGetDataPath())
                    ->mode('normal')
                    ->data(['id' => '${id}'])
                    ->body([
                        amisMake()->TreeControl()
                            ->name('permissions')
                            ->label('')
                            ->multiple(true)
                            ->options(AdminPermissionService::make()->getTree())
                            ->searchable(true)
                            ->autoCheckChildren(false)
                            ->joinValues(false)
                            ->extractValue(true)
                            ->size('full')
                            ->className('h-full b-none')
                            ->inputClassName('h-full tree-full')
                            ->labelField('name')
                            ->valueField('id'),
                    ]),
            ])->footer([
                amisMake()->Button()->label('保存')->type('submit')->level('primary'),
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
            amisMake()->TextControl()->label(__('admin.admin_role.name'))->name('name')->required(true),
            amisMake()->TextControl()
                ->label(__('admin.admin_role.slug'))
                ->name('slug')
                ->description(__('admin.admin_role.slug_description'))
                ->required(true),
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }
}
