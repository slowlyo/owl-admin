<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Services\AdminMenuService;

/**
 * @property AdminMenuService $service
 */
class AdminMenuController extends AdminController
{
    protected string $serviceName = AdminMenuService::class;

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->loadDataOnce()
            ->syncLocation(false)
            ->footerToolbar([])
            ->headerToolbar([
                $this->createButton(true, 'lg'),
                ...$this->baseHeaderToolBar(),
            ])
            ->filterTogglable(false)
            ->footerToolbar(['statistics'])
            ->bulkActions([$this->bulkDeleteButton()->reload('window')])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('title', __('admin.admin_menu.title')),
                amis()->TableColumn('icon', __('admin.admin_menu.icon'))
                    ->type('flex')
                    ->justify('start')
                    ->items([
                        amis()->SvgIcon()->icon('${icon}')->className('mr-2 text-lg'),
                        '${icon}',
                    ]),
                amis()->TableColumn('url', __('admin.admin_menu.url')),
                amis()->TableColumn('order', __('admin.admin_menu.order'))->quickEdit(
                    amis()->NumberControl()->min(0)->saveImmediately(true)
                ),
                amis()->TableColumn('visible', __('admin.admin_menu.visible'))->quickEdit(
                    amis()->SwitchControl()->mode('inline')->saveImmediately(true)
                ),
                amis()->TableColumn('is_home', __('admin.admin_menu.is_home'))->quickEdit(
                    amis()->SwitchControl()->mode('inline')->saveImmediately(true)
                ),
                $this->rowActions([
                    $this->rowEditButton(true, 'lg'),
                    $this->rowDeleteButton(),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            amis()->GroupControl()->body([
                amis()->TextControl('title', __('admin.admin_menu.title'))->required(),
                amis()->TextControl('icon', __('admin.admin_menu.icon'))
                    ->description(
                        __('admin.admin_menu.icon_description') .
                        '<a href="https://icones.js.org/collection/all" target="_blank"> https://icones.js.org</a>'
                    ),
            ]),
            amis()->GroupControl()->body([
                amis()->TreeSelectControl('parent_id', __('admin.admin_menu.parent_id'))
                    ->labelField('title')
                    ->valueField('id')
                    ->showIcon(false)
                    ->value(0)
                    ->source('/system/admin_menus?_action=getData'),
                amis()
                    ->TextControl('component', __('admin.admin_menu.component'))
                    ->description(__('admin.admin_menu.component_desc'))
                    ->value('amis'),
            ]),
            amis()->TextControl('url', __('admin.admin_menu.url'))
                ->required()
                ->validateOnChange()
                ->validations(['matchRegexp' => '/^(http(s)?\:\/)?(\/)+/'])
                ->validationErrors(['matchRegexp' => __('admin.need_start_with_slash')])
                ->placeholder('eg: /admin_menus'),
            amis()->NumberControl('order', __('admin.admin_menu.order'))
                ->required()
                ->displayMode('enhance')
                ->description(__('admin.order_asc'))
                ->min(0)
                ->value(0),
            amis()->ListControl('url_type', __('admin.admin_menu.type'))
                ->options(Admin::adminMenuModel()::getType())
                ->value(Admin::adminMenuModel()::TYPE_ROUTE),
            amis()->SwitchControl('visible', __('admin.admin_menu.visible'))
                ->onText(__('admin.admin_menu.show'))
                ->offText(__('admin.admin_menu.hide'))
                ->value(1),
            amis()->SwitchControl('is_home', __('admin.admin_menu.is_home'))
                ->onText(__('admin.yes'))
                ->offText(__('admin.no'))
                ->description(__('admin.admin_menu.is_home_description'))
                ->value(0),
            amis()->SwitchControl('is_full', __('admin.admin_menu.is_full'))
                ->onText(__('admin.yes'))
                ->offText(__('admin.no'))
                ->description(__('admin.admin_menu.is_full_description'))
                ->value(0),
        ])->onEvent([
            'submitSucc' => [
                'actions' => [
                    'actionType' => 'custom',
                    'script'     => 'window.location.reload()',
                ],
            ],
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }
}
