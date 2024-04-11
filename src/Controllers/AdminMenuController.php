<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Traits\IconifyPickerTrait;
use Slowlyo\OwlAdmin\Services\AdminPageService;

/**
 * @property AdminMenuService $service
 */
class AdminMenuController extends AdminController
{
    use IconifyPickerTrait;

    protected string $serviceName = AdminMenuService::class;

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->draggable()
            ->saveOrderApi([
                'url'  => '/system/admin_menus/save_order',
                'data' => ['ids' => '${ids}'],
            ])
            ->loadDataOnce()
            ->syncLocation(false)
            ->footerToolbar([])
            ->headerToolbar([$this->createButton(true, 'lg'), ...$this->baseHeaderToolBar()])
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
                $this->iconifyPicker('icon', __('admin.admin_menu.icon')),
            ]),
            amis()->GroupControl()->body([
                amis()->TreeSelectControl('parent_id', __('admin.admin_menu.parent_id'))
                    ->labelField('title')
                    ->valueField('id')
                    ->showIcon(false)
                    ->value(0)
                    ->source('/system/admin_menus?_action=getData'),
                amis()->NumberControl('order', __('admin.admin_menu.order'))
                    ->required()
                    ->displayMode('enhance')
                    ->description(__('admin.order_asc'))
                    ->min(0)
                    ->value(0),
            ]),
            amis()->ListControl('url_type', __('admin.admin_menu.type'))
                ->options(Admin::adminMenuModel()::getType())
                ->value(Admin::adminMenuModel()::TYPE_ROUTE),
            amis()->TextControl('url', __('admin.admin_menu.url'))
                ->required()
                ->validateOnChange()
                ->validations(['matchRegexp' => '/^(http(s)?\:\/)?(\/)+/'])
                ->validationErrors(['matchRegexp' => __('admin.need_start_with_slash')])
                ->placeholder('eg: /admin_menus')->hiddenOn('url_type != ' . Admin::adminMenuModel()::TYPE_LINK),

            amis()->TextControl('url', __('admin.admin_menu.route'))
                ->required()
                ->validateOnChange()
                ->validations(['matchRegexp' => '/^(http(s)?\:\/)?(\/)+/'])
                ->validationErrors(['matchRegexp' => __('admin.need_start_with_slash')])
                ->placeholder('eg: /admin_menus')->hiddenOn('url_type == ' . Admin::adminMenuModel()::TYPE_LINK),

            amis()->TextControl('component', __('admin.admin_menu.component'))
                ->description(__('admin.admin_menu.component_desc'))
                ->value('amis')->hiddenOn('url_type != ' . Admin::adminMenuModel()::TYPE_ROUTE),

            amis()->SelectControl('component', __('admin.admin_menu.page'))
                ->required()
                ->options(AdminPageService::make()->options())
                ->menuTpl('${label} <span class="text-gray-300 pl-2">${value}</span>')
                ->selectFirst()
                ->searchable()
                ->visibleOn('url_type == ' . Admin::adminMenuModel()::TYPE_PAGE),

            amis()->GroupControl()->body([
                amis()->TextControl('iframe_url', 'IframeUrl')
                    ->required()
                    ->validateOnChange()
                    ->validations(['matchRegexp' => '/^(http(s)?\:\/)?(\/)+/'])
                    ->validationErrors(['matchRegexp' => __('admin.need_start_with_slash')])
                    ->placeholder('eg: https://www.qq.com')
                    ->hiddenOn('url_type != ' . Admin::adminMenuModel()::TYPE_IFRAME),
            ]),

            amis()->SwitchControl('keep_alive', __('admin.admin_menu.keep_alive'))
                ->onText(__('admin.yes'))
                ->offText(__('admin.no'))
                ->description(__('admin.admin_menu.iframe_description'))
                ->value(0),

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

    /**
     * 保存排序
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function saveOrder()
    {
        return $this->autoResponse($this->service->reorder(request()->input('ids')));
    }
}
