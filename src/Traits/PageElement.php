<?php

namespace Slowlyo\SlowAdmin\Traits;

use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\CRUD;
use Slowlyo\SlowAdmin\Renderers\Button;
use Slowlyo\SlowAdmin\Renderers\Action;
use Slowlyo\SlowAdmin\Renderers\Dialog;
use Slowlyo\SlowAdmin\Renderers\Component;
use Slowlyo\SlowAdmin\Renderers\Form\Form;
use Slowlyo\SlowAdmin\Renderers\BaseRenderer;

trait PageElement
{
    /**
     * 基础页面
     *
     * @param mixed ...$assets
     *
     * @return Page
     */
    protected function basePage(...$assets): Page
    {
        $page = Page::make()->title($this->pageTitle);

        // 注入js
        if ($assets) {
            $script      = collect($assets)->pluck('script')->implode('');
            $systemTheme = config('admin.layout.theme');
            $className   = $systemTheme . '-Page';
            if (!$systemTheme || $systemTheme == 'default') {
                $className = 'cxd-Page';
            }
            $page->initApi(url(config('admin.route.prefix') . '/no-content'))->onEvent([
                'inited' => [
                    'actions' => [
                        'actionType' => 'custom',
                        'script'     => <<<JS
let inner = document.getElementsByClassName('{$className}');
let myJs = document.createElement('script');
myJs.innerHTML = `$script`;
inner[0].appendChild(myJs);
JS
                        ,
                    ],
                ],
            ]);
        }

        return $page;
    }

    /**
     * 返回列表按钮
     *
     * @return Action
     */
    protected function backButton(): Action
    {
        return Button::make()
            ->label('返回')
            ->icon('fa-solid fa-chevron-left')
            ->level('primary')
            ->onClick('window.history.back()');
    }

    /**
     * 批量删除按钮
     *
     * @return Action
     */
    protected function bulkDeleteButton(): Action
    {
        return Action::make()
            ->actionType('ajax')
            ->api($this->getBulkDeletePath())
            ->icon('fa fa-trash-o')
            ->label('删除')
            ->confirmText('确认删除选中数据?');
    }

    /**
     * 新增按钮
     *
     * @param bool $dialog
     *
     * @return Action
     */
    protected function createButton($dialog = false): Action
    {
        $form = $this->form()->api($this->getStorePath());

        $button = Button::make()
            ->label('新增')
            ->icon('fa fa-add')
            ->level('primary');

        if ($dialog) {
            $button->actionType('dialog')->dialog(Dialog::make()->title('新增')->body($form));
        } else {
            $button = $button->actionType('link')->link($this->getCreatePath());
        }

        return $button;
    }

    /**
     * 行编辑按钮
     *
     * @param bool $dialog
     *
     * @return Action
     */
    protected function rowEditButton($dialog = false): Action
    {
        $button = Button::make()
            ->label('编辑')
            ->icon('fa-regular fa-pen-to-square')
            ->level('link');

        if ($dialog) {
            $form = $this->form()->api($this->getUpdatePath('$id'))->initApi($this->getEditGetDataPath('$id'));

            $button = $button->actionType('dialog')->dialog(Dialog::make()->title('编辑')->body($form));
        } else {
            $button = $button->actionType('link')->link($this->getEditPath());
        }

        return $button;
    }

    /**
     * 行详情按钮
     *
     * @param bool $dialog
     *
     * @return Action
     */
    protected function rowShowButton($dialog = false): Action
    {
        $button = Button::make()
            ->label('详情')
            ->icon('fa-regular fa-eye')
            ->level('link');

        if ($dialog) {
            $button = $button->actionType('dialog')->dialog(Dialog::make()->title('详情')->body($this->detail('$id')));
        } else {
            $button = $button->actionType('link')->link($this->getShowPath());
        }

        return $button;
    }

    /**
     * 行删除按钮
     *
     * @return Action
     */
    protected function rowDeleteButton(): Action
    {
        return Button::make()
            ->label('删除')
            ->icon('fa-regular fa-trash-can')
            ->level('link')
            ->className('text-danger')
            ->actionType('ajax')
            ->confirmText('确认删除该条数据?')
            ->api($this->getDeletePath());
    }

    /**
     * 操作列
     *
     * @param bool $dialog
     *
     * @return BaseRenderer
     */
    protected function rowActions($dialog = false): BaseRenderer
    {
        return Component::make()->setType('operation')->label('操作')->buttons([
            $this->rowShowButton($dialog),
            $this->rowEditButton($dialog),
            $this->rowDeleteButton(),
        ]);
    }

    protected function rowActionsOnlyEditAndDelete($dialog = false): BaseRenderer
    {
        return Component::make()->setType('operation')->label('操作')->buttons([
            $this->rowEditButton($dialog),
            $this->rowDeleteButton(),
        ]);
    }

    /**
     * 基础筛选器
     *
     * @return Form
     */
    protected function baseFilter(): Form
    {
        return Form::make()
            ->panelClassName('base-filter')
            ->title('')
            ->actions([
                Button::make()->label('重置')->actionType('clear-and-submit'),
                amis('submit')->label('搜索')->level('primary'),
            ]);
    }

    /**
     * @return CRUD
     */
    protected function baseCRUD(): CRUD
    {
        return CRUD::make()
            ->perPage(20)
            ->affixHeader(false)
            ->filterTogglable(true)
            ->filterDefaultVisible(false)
            ->api($this->getListGetDataPath())
            ->bulkActions([$this->bulkDeleteButton()])
            ->perPageAvailable([10, 20, 30, 50, 100, 200])
            ->footerToolbar(['switch-per-page', 'statistics', 'pagination'])
            ->headerToolbar([
                'filter-toggler',
                'bulkActions',
                Component::make()->setType('reload')->align('right'),
            ]);
    }

    /**
     * 基础表单
     *
     * @return Form
     */
    protected function baseForm(): Form
    {
        return Form::make()->panelClassName('px-48')->title(' ')->mode('horizontal')->redirect($this->getListPath());
    }

    /**
     * @param $id
     *
     * @return Form
     */
    protected function baseDetail($id): Form
    {
        return Form::make()
            ->panelClassName('px-48')
            ->title(' ')
            ->mode('horizontal')
            ->actions([])
            ->initApi($this->getShowGetDataPath($id));
    }

    /**
     * 基础列表
     *
     * @param $crud
     *
     * @return Page
     */
    protected function baseList($crud): Page
    {
        return $this->basePage()->subTitle('列表')->toolbar([$this->createButton()])->body($crud);
    }
}
