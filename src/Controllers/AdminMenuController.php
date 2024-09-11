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
            ->perPage(999)
            ->draggable()
            ->saveOrderApi([
                'url'  => '/system/admin_menus/save_order',
                'data' => ['ids' => '${ids}'],
            ])
            ->loadDataOnce()
            ->syncLocation(false)
            ->headerToolbar([$this->createButton(true, 'lg'), ...$this->baseHeaderToolBar()])
            ->filterTogglable(false)
            ->footerToolbar(['statistics'])
            ->bulkActions([$this->bulkDeleteButton()->reload('window')])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('title', admin_trans('admin.admin_menu.title')),
                amis()->TableColumn('icon', admin_trans('admin.admin_menu.icon'))
                    ->type('flex')
                    ->className('text-center h-full')
                    ->justify('start')
                    ->items('center')
                    ->items([
                        amis()->Wrapper()->size('none')->body(
                            amis()->SvgIcon()->icon('${icon}')->className('mr-2 text-xl h-full')
                        ),
                        amis()->Tpl()->tpl('${icon}'),
                    ]),
                amis()->TableColumn('url', admin_trans('admin.admin_menu.url')),
                amis()->TableColumn('custom_order', admin_trans('admin.admin_menu.order'))->quickEdit(
                    amis()->NumberControl()->min(0)->saveImmediately()
                ),
                amis()->TableColumn('visible', admin_trans('admin.admin_menu.visible'))->quickEdit(
                    amis()->SwitchControl()->mode('inline')->saveImmediately()
                ),
                amis()->TableColumn('is_home', admin_trans('admin.admin_menu.is_home'))->quickEdit(
                    amis()->SwitchControl()->mode('inline')->saveImmediately()
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
                amis()->TextControl('title', admin_trans('admin.admin_menu.title'))->required(),
                $this->iconifyPicker('icon', admin_trans('admin.admin_menu.icon')),
            ]),
            amis()->GroupControl()->body([
                amis()->TreeSelectControl('parent_id', admin_trans('admin.admin_menu.parent_id'))
                    ->labelField('title')
                    ->valueField('id')
                    ->showIcon(false)
                    ->value(0)
                    ->source('/system/admin_menus?_action=getData'),
                amis()->NumberControl('custom_order', admin_trans('admin.admin_menu.order'))
                    ->required()
                    ->displayMode('enhance')
                    ->description(admin_trans('admin.order_asc'))
                    ->min(0)
                    ->value(0),
            ]),
            amis()->ListControl('url_type', admin_trans('admin.admin_menu.type'))
                ->options(Admin::adminMenuModel()::getType())
                ->value(Admin::adminMenuModel()::TYPE_ROUTE),
            amis()->TextControl('url', admin_trans('admin.admin_menu.url'))
                ->required()
                ->validateOnChange()
                ->validations(['matchRegexp' => '/^(http(s)?\:\/)?(\/)+/'])
                ->validationErrors(['matchRegexp' => admin_trans('admin.need_start_with_slash')])
                ->placeholder('eg: /admin_menus')->hiddenOn('url_type != ' . Admin::adminMenuModel()::TYPE_LINK),

            amis()->TextControl('url', admin_trans('admin.admin_menu.route'))
                ->required()
                ->validateOnChange()
                ->validations(['matchRegexp' => '/^(http(s)?\:\/)?(\/)+/'])
                ->validationErrors(['matchRegexp' => admin_trans('admin.need_start_with_slash')])
                ->placeholder('eg: /admin_menus')->hiddenOn('url_type == ' . Admin::adminMenuModel()::TYPE_LINK),

            amis()->TextControl('component', admin_trans('admin.admin_menu.component'))
                ->description(admin_trans('admin.admin_menu.component_desc'))
                ->value('amis')->hiddenOn('url_type != ' . Admin::adminMenuModel()::TYPE_ROUTE),

            amis()->SelectControl('component', admin_trans('admin.admin_menu.page'))
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
                    ->validationErrors(['matchRegexp' => admin_trans('admin.need_start_with_slash')])
                    ->placeholder('eg: https://www.qq.com')
                    ->hiddenOn('url_type != ' . Admin::adminMenuModel()::TYPE_IFRAME),
            ]),

            amis()->SwitchControl('keep_alive', admin_trans('admin.admin_menu.keep_alive'))
                ->onText(admin_trans('admin.yes'))
                ->offText(admin_trans('admin.no'))
                ->description(admin_trans('admin.admin_menu.iframe_description'))
                ->value(0),

            amis()->SwitchControl('visible', admin_trans('admin.admin_menu.visible'))
                ->onText(admin_trans('admin.admin_menu.show'))
                ->offText(admin_trans('admin.admin_menu.hide'))
                ->value(1),
            amis()->SwitchControl('is_home', admin_trans('admin.admin_menu.is_home'))
                ->onText(admin_trans('admin.yes'))
                ->offText(admin_trans('admin.no'))
                ->description(admin_trans('admin.admin_menu.is_home_description'))
                ->value(0),
            amis()->SwitchControl('is_full', admin_trans('admin.admin_menu.is_full'))
                ->onText(admin_trans('admin.yes'))
                ->offText(admin_trans('admin.no'))
                ->description(admin_trans('admin.admin_menu.is_full_description'))
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
