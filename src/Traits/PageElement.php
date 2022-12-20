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
     * @return Page
     */
    protected function basePage(): Page
    {
        return Page::make()->className('m:overflow-auto')->title($this->pageTitle);
    }

    /**
     * 返回列表按钮
     *
     * @return Action
     */
    protected function backButton(): Action
    {
        return Button::make()
            ->label(__('admin.back'))
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
            ->icon('fa-solid fa-trash-can')
            ->label(__('admin.delete'))
            ->confirmText(__('admin.confirm_delete'));
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
            ->label(__('admin.create'))
            ->icon('fa fa-add')
            ->level('primary');

        if ($dialog) {
            $button->actionType('dialog')->dialog(Dialog::make()->title(__('admin.create'))->body($form));
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
            ->label(__('admin.edit'))
            ->icon('fa-regular fa-pen-to-square')
            ->level('link');

        if ($dialog) {
            $form = $this->form()->api($this->getUpdatePath('$id'))->initApi($this->getEditGetDataPath('$id'));

            $button = $button->actionType('dialog')->dialog(Dialog::make()->title(__('admin.edit'))->body($form));
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
            ->label(__('admin.show'))
            ->icon('fa-regular fa-eye')
            ->level('link');

        if ($dialog) {
            $button = $button->actionType('dialog')->dialog(Dialog::make()
                ->title(__('admin.show'))
                ->body($this->detail('$id')));
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
            ->label(__('admin.delete'))
            ->icon('fa-regular fa-trash-can')
            ->level('link')
            ->className('text-danger')
            ->actionType('ajax')
            ->confirmText(__('admin.confirm_delete'))
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
        return Component::make()->setType('operation')->label(__('admin.actions'))->buttons([
            $this->rowShowButton($dialog),
            $this->rowEditButton($dialog),
            $this->rowDeleteButton(),
        ]);
    }

    protected function rowActionsOnlyEditAndDelete($dialog = false): BaseRenderer
    {
        return Component::make()->setType('operation')->label(__('admin.actions'))->buttons([
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
                Button::make()->label(__('admin.reset'))->actionType('clear-and-submit'),
                amis('submit')->label(__('admin.search'))->level('primary'),
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
                $this->createButton(),
                'bulkActions',
                amis('reload')->align('right'),
                amis('filter-toggler')->align('right'),
            ]);
    }

    /**
     * 基础表单
     *
     * @return Form
     */
    protected function baseForm(): Form
    {
        return Form::make()->panelClassName('px-48 m:px-0')->title(' ')->mode('horizontal')->redirect($this->getListPath());
    }

    /**
     * @param $id
     *
     * @return Form
     */
    protected function baseDetail($id): Form
    {
        return Form::make()
            ->panelClassName('px-48 m:px-0')
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
        return $this->basePage()->subTitle(__('admin.list'))->body($crud);
    }
}
