<?php

namespace Slowlyo\OwlAdmin\Traits;

use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Support\Cores\AdminPipeline;

trait ElementTrait
{
    /**
     * 基础页面
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Page
     */
    protected function basePage()
    {
        return AdminPipeline::handle(
            AdminPipeline::PIPE_BASE_PAGE,
            amis()->Page()->className('m:overflow-auto')
        );
    }

    /**
     * 返回列表按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\OtherAction
     */
    protected function backButton()
    {
        $path   = str_replace(Admin::config('admin.route.prefix'), '', request()->path());
        $script = sprintf('window.$owl.hasOwnProperty(\'closeTabByPath\') && window.$owl.closeTabByPath(\'%s\')', $path);

        $action = amis()
            ->OtherAction()
            ->label(admin_trans('admin.back'))
            ->icon('fa-solid fa-chevron-left')
            ->level('primary')
            ->onClick('window.history.back();' . $script);

        return AdminPipeline::handle(AdminPipeline::PIPE_BACK_ACTION, $action);
    }

    /**
     * 批量删除按钮
     */
    protected function bulkDeleteButton()
    {
        $action = amis()
            ->DialogAction()
            ->label(admin_trans('admin.delete'))
            ->icon('fa-solid fa-trash-can')
            ->dialog(
                amis()
                    ->Dialog()
                    ->title(admin_trans('admin.delete'))
                    ->className('py-2')
                    ->actions([
                        amis()->Action()->actionType('cancel')->label(admin_trans('admin.cancel')),
                        amis()->Action()->actionType('submit')->label(admin_trans('admin.delete'))->level('danger'),
                    ])
                    ->body([
                        amis()->Form()->wrapWithPanel(false)->api($this->getBulkDeletePath())->body([
                            amis()->Tpl()->className('py-2')->tpl(admin_trans('admin.confirm_delete')),
                        ]),
                    ])
            );

        return AdminPipeline::handle(AdminPipeline::PIPE_BULK_DELETE_ACTION, $action);
    }

    /**
     * 新增按钮
     *
     * @param bool|string $dialog     是否弹窗, 弹窗: true|dialog, 抽屉: drawer,
     * @param string      $dialogSize 弹窗大小, 默认: md, 可选值: xs | sm | md | lg | xl | full
     * @param string      $title      弹窗标题 & 按钮文字, 默认: 新增
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction|\Slowlyo\OwlAdmin\Renderers\LinkAction
     */
    protected function createButton(bool|string $dialog = false, string $dialogSize = 'md', string $title = '')
    {
        $title  = $title ?: admin_trans('admin.create');
        $action = amis()->LinkAction()->link($this->getCreatePath());

        if ($dialog) {
            $form = $this->form(false)->canAccessSuperData(false)->api($this->getStorePath());

            if ($dialog === 'drawer') {
                $action = amis()->DrawerAction()->drawer(
                    amis()->Drawer()->title($title)->body($form)->size($dialogSize)
                );
            } else {
                $action = amis()->DialogAction()->dialog(
                    amis()->Dialog()->title($title)->body($form)->size($dialogSize)
                );
            }
        }

        $action->label($title)->icon('fa fa-add')->level('primary');

        return AdminPipeline::handle(AdminPipeline::PIPE_CREATE_ACTION, $action);
    }

    /**
     * 行编辑按钮
     *
     * @param bool|string $dialog     是否弹窗, 弹窗: true|dialog, 抽屉: drawer,
     * @param string      $dialogSize 弹窗大小, 默认: md, 可选值: xs | sm | md | lg | xl | full
     * @param string      $title      弹窗标题 & 按钮文字, 默认: 编辑
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction|\Slowlyo\OwlAdmin\Renderers\LinkAction
     */
    protected function rowEditButton(bool|string $dialog = false, string $dialogSize = 'md', string $title = '')
    {
        $title  = $title ?: admin_trans('admin.edit');
        $action = amis()->LinkAction()->link($this->getEditPath());

        if ($dialog) {
            $form = $this
                ->form(true)
                ->api($this->getUpdatePath())
                ->initApi($this->getEditGetDataPath())
                ->redirect('');

            if ($dialog === 'drawer') {
                $action = amis()->DrawerAction()->drawer(
                    amis()->Drawer()->title($title)->body($form)->size($dialogSize)
                );
            } else {
                $action = amis()->DialogAction()->dialog(
                    amis()->Dialog()->title($title)->body($form)->size($dialogSize)
                );
            }
        }

        $action->label($title)->level('link');

        return AdminPipeline::handle(AdminPipeline::PIPE_EDIT_ACTION, $action);
    }

    /**
     * 行详情按钮
     *
     * @param bool|string $dialog     是否弹窗, 弹窗: true|dialog, 抽屉: drawer
     * @param string      $dialogSize 弹窗大小, 默认: md, 可选值: xs | sm | md | lg | xl | full
     * @param string      $title      弹窗标题 & 按钮文字, 默认: 详情
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction|\Slowlyo\OwlAdmin\Renderers\LinkAction
     */
    protected function rowShowButton(bool|string $dialog = false, string $dialogSize = 'md', string $title = '')
    {
        $title  = $title ?: admin_trans('admin.show');
        $action = amis()->LinkAction()->link($this->getShowPath());

        if ($dialog) {
            if ($dialog === 'drawer') {
                $action = amis()->DrawerAction()->drawer(
                    amis()
                        ->Drawer()
                        ->title($title)
                        ->body($this->detail('$id'))
                        ->size($dialogSize)
                        ->actions([])
                        ->closeOnEsc()
                        ->closeOnOutside()
                );
            } else {
                $action = amis()->DialogAction()->dialog(
                    amis()
                        ->Dialog()
                        ->title($title)
                        ->body($this->detail('$id'))
                        ->size($dialogSize)
                        ->actions([])
                        ->closeOnEsc()
                        ->closeOnOutside()
                );
            }
        }

        $action->label($title)->level('link');

        return AdminPipeline::handle(AdminPipeline::PIPE_SHOW_ACTION, $action);
    }

    /**
     * 行删除按钮
     *
     * @param string $title
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    protected function rowDeleteButton(string $title = '')
    {
        $action = amis()
            ->DialogAction()
            ->label($title ?: admin_trans('admin.delete'))
            ->level('link')
            ->className('text-danger')
            ->dialog(
                amis()
                    ->Dialog()
                    ->title()
                    ->className('py-2')
                    ->actions([
                        amis()->Action()->actionType('cancel')->label(admin_trans('admin.cancel')),
                        amis()->Action()->actionType('submit')->label(admin_trans('admin.delete'))->level('danger'),
                    ])
                    ->body([
                        amis()->Form()->wrapWithPanel(false)->api($this->getDeletePath())->body([
                            amis()->Tpl()->className('py-2')->tpl(admin_trans('admin.confirm_delete')),
                        ]),
                    ])
            );

        return AdminPipeline::handle(AdminPipeline::PIPE_DELETE_ACTION, $action);
    }

    /**
     * 操作列
     *
     * @param bool|array|string $dialog     是否弹窗, 弹窗: true|dialog, 抽屉: drawer
     * @param string            $dialogSize 弹窗大小, 默认: md, 可选值: xs | sm | md | lg | xl | full
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Operation
     */
    protected function rowActions(bool|array|string $dialog = false, string $dialogSize = 'md')
    {
        if (is_array($dialog)) {
            return amis()->Operation()->label(admin_trans('admin.actions'))->buttons($dialog);
        }

        $actions = amis()->Operation()->label(admin_trans('admin.actions'))->buttons([
            $this->rowShowButton($dialog, $dialogSize),
            $this->rowEditButton($dialog, $dialogSize),
            $this->rowDeleteButton(),
        ]);

        return AdminPipeline::handle(AdminPipeline::PIPE_ROW_ACTIONS, $actions);
    }

    /**
     * 基础筛选器
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Form
     */
    protected function baseFilter()
    {
        $schema = amis()
            ->Form()
            ->panelClassName('base-filter')
            ->title('')
            ->actions([
                amis()->Button()->label(admin_trans('admin.reset'))->actionType('clear-and-submit'),
                amis('submit')->label(admin_trans('admin.search'))->level('primary'),
            ]);

        return AdminPipeline::handle(AdminPipeline::PIPE_BASE_FILTER, $schema);
    }

    /**
     * 基础筛选器 - 条件构造器
     *
     * @return \Slowlyo\OwlAdmin\Renderers\ConditionBuilderControl
     */
    protected function baseFilterConditionBuilder()
    {
        return amis()->ConditionBuilderControl('filter_condition_builder');
    }

    /**
     * @return \Slowlyo\OwlAdmin\Renderers\CRUDTable
     */
    protected function baseCRUD()
    {
        $crudId = str_replace('/', '.', request()->path()) . '.crud';

        $crud = amis()
            ->CRUDTable()
            ->id($crudId)
            ->perPage(20)
            ->alwaysShowPagination()
            ->affixHeader(false)
            ->filterTogglable()
            ->filterDefaultVisible(false)
            ->api($this->getListGetDataPath())
            ->quickSaveApi($this->getQuickEditPath())
            ->quickSaveItemApi($this->getQuickEditItemPath())
            ->bulkActions([$this->bulkDeleteButton()])
            ->footerToolbar([
                'statistics',
                // 重写实现 CRUD 自带的页码切换组件, 解决下拉被遮挡的问题
                amis()->Form()->wrapWithPanel(false)->body([
                    amis()
                        ->SelectControl('perPage')
                        ->options(array_map(
                            fn($i) => ['label' => $i . ' ' . admin_trans('admin.per_page_suffix'), 'value' => $i],
                            [20, 30, 50, 100, 200]
                        ))
                        ->selectFirst()
                        ->set('overlayPlacement', 'top')
                        ->onEvent([
                            'change' => [
                                'actions' => [
                                    [
                                        'actionType'  => 'reload',
                                        'componentId' => $crudId,
                                        'data'        => ['perPage' => '${event.data.value}'],
                                    ],
                                ],
                            ],
                        ]),
                ])->target('window'),
                'pagination',
            ])
            ->headerToolbar([
                $this->createButton(),
                ...$this->baseHeaderToolBar(),
            ]);

        if (isset($this->service)) {
            $crud->set('primaryField', $this->service->primaryKey());
        }

        return AdminPipeline::handle(AdminPipeline::PIPE_BASE_CRUD, $crud);
    }

    /**
     * 基础顶部工具栏
     *
     * @return array
     */
    protected function baseHeaderToolBar()
    {
        $schema = [
            'bulkActions',
            amis('reload')->align('right'),
            amis('filter-toggler')->align('right'),
        ];

        return AdminPipeline::handle(AdminPipeline::PIPE_BASE_HEADER_TOOLBAR, $schema);
    }

    /**
     * 基础表单
     *
     * @param bool $back
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Form
     */
    protected function baseForm(bool $back = false)
    {
        $path = str_replace(Admin::config('admin.route.prefix'), '', request()->path());

        $form = amis()->Form()->panelClassName('px-48 m:px-0')->title(' ')->promptPageLeave();

        if ($back) {
            $form->onEvent([
                'submitSucc' => [
                    'actions' => [
                        ['actionType' => 'custom', 'script' => 'window.history.back()'],
                        [
                            'actionType' => 'custom',
                            'script'     => sprintf('window.$owl.hasOwnProperty(\'closeTabByPath\') && window.$owl.closeTabByPath(\'%s\')', $path),
                        ],
                    ],
                ],
            ]);
        }

        return AdminPipeline::handle(AdminPipeline::PIPE_BASE_FORM, $form);
    }

    /**
     * @return \Slowlyo\OwlAdmin\Renderers\Form
     */
    protected function baseDetail()
    {
        $schema = amis()
            ->Form()
            ->panelClassName('px-48 m:px-0')
            ->title(' ')
            ->mode('horizontal')
            ->actions([])
            ->initApi($this->getShowGetDataPath());

        return AdminPipeline::handle(AdminPipeline::PIPE_BASE_DETAIL, $schema);
    }

    /**
     * 基础列表
     *
     * @param $crud
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Page
     */
    protected function baseList($crud)
    {
        return AdminPipeline::handle(AdminPipeline::PIPE_BASE_LIST, $this->basePage()->body([
            $crud,
            // 添加几个空元素, 规避 https://github.com/baidu/amis/issues/10983 这个问题
            [],
            [],
            [],
        ]));
    }

    /**
     * 导出按钮
     *
     * @param bool $disableSelectedItem
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Service
     */
    protected function exportAction($disableSelectedItem = false)
    {
        // 获取主键名称
        $primaryKey = $this->service->primaryKey();
        // 下载路径
        $downloadPath = admin_url('_download_export', true);
        // 导出接口地址
        $exportPath = $this->getExportPath();
        // 无数据提示
        $pageNoData = admin_trans('admin.export.page_no_data');
        // 选中行无数据提示
        $selectedNoData = admin_trans('admin.export.selected_rows_no_data');
        // 按钮点击事件
        $event = fn($script) => ['click' => ['actions' => [['actionType' => 'custom', 'script' => $script]]]];
        // 导出处理动作
        $doAction = "doAction([{actionType:'setValue',componentId:'export-action',args:{value:{showExportLoading:true}}},{actionType:'ajax',args:{api:{url:url.toString(),method:'get'}}},{actionType:'setValue',componentId:'export-action',args:{value:{showExportLoading:false}}},{actionType:'custom',expression:'\${event.data.responseResult.responseStatus===0}',script:'window.open(\'{$downloadPath}?path=\'+event.data.responseResult.responseData.path)'}])";
        // 按钮
        $buttons = [
            // 导出全部
            amis()->VanillaAction()->label(admin_trans('admin.export.all'))->onEvent(
                $event("let data=event.data;let params=Object.keys(data).filter(key=>key!=='page' && key!=='__super').reduce((obj,key)=>{obj[key]=data[key];return obj;},{});let url=new URL('{$exportPath}',window.location.origin);Object.keys(params).forEach(key=>url.searchParams.append(key,(typeof params[key] == 'string' ? params[key] : JSON.stringify(params[key]))));{$doAction}")
            ),
            // 导出本页
            amis()->VanillaAction()->label(admin_trans('admin.export.page'))->onEvent(
                $event("let ids=event.data.items.map(item=>item.{$primaryKey});if(ids.length===0){return doAction({actionType:'toast',args:{msgType:'warning',msg:'{$pageNoData}'}})};let url=new URL('{$exportPath}',window.location.origin);url.searchParams.append('_ids',ids.join(','));{$doAction}")
            ),
        ];
        // 导出选中项
        if (!$disableSelectedItem) {
            $buttons[] = amis()->VanillaAction()->label(admin_trans('admin.export.selected_rows'))->onEvent(
                $event("let ids=event.data.selectedItems.map(item=>item.{$primaryKey});if(ids.length===0){return doAction({actionType:'toast',args:{msgType:'warning',msg:'{$selectedNoData}'}})};let url=new URL('{$exportPath}',window.location.origin);url.searchParams.append('_ids',ids.join(','));{$doAction}")
            );
        }

        $action = amis()
            ->Service()
            ->id('export-action')
            ->set('align', 'right')
            ->set('data', ['showExportLoading' => false])
            ->body(
                amis()->Spinner()->set('showOn', '${showExportLoading}')->overlay()->body(
                    amis()
                        ->DropdownButton()
                        ->label(admin_trans('admin.export.title'))
                        ->set('icon', 'fa-solid fa-download')
                        ->buttons($buttons)
                        ->closeOnClick()
                        ->align('right')
                )
            );

        return AdminPipeline::handle(AdminPipeline::PIPE_EXPORT_ACTION, $action);
    }
}
