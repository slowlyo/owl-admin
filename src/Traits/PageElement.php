<?php

namespace Slowlyo\SlowAdmin\Traits;

use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\CRUD;
use Slowlyo\SlowAdmin\Renderers\Button;
use Slowlyo\SlowAdmin\Renderers\Action;
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
        return Page::make()->title($this->pageTitle);
    }

    /**
     * 返回列表按钮
     *
     * @return Action
     */
    protected function backListButton(): Action
    {
        return Button::make()
            ->label('列表')
            ->icon('fa fa-list')
            ->level('primary')
            ->actionType('link')
            ->link($this->getListPath());
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
     * @return Action
     */
    protected function createButton(): Action
    {
        return Button::make()
            ->label('新增')
            ->icon('fa fa-add')
            ->level('primary')
            ->actionType('link')
            ->link($this->getCreatePath());
    }

    /**
     * 行编辑按钮
     *
     * @return Action
     */
    protected function rowEditButton(): Action
    {
        return Button::make()
            ->label('编辑')
            ->icon('fa-regular fa-pen-to-square')
            ->level('link')
            ->actionType('link')
            ->link($this->getEditPath());
    }

    /**
     * 行详情按钮
     *
     * @return Action
     */
    protected function rowShowButton(): Action
    {
        return Button::make()
            ->label('详情')
            ->icon('fa-regular fa-eye')
            ->level('link')
            ->actionType('link')
            ->link($this->getShowPath());
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
     * @return BaseRenderer
     */
    protected function rowActions(): BaseRenderer
    {
        return Component::make()->setType('operation')->label('操作')->buttons([
            $this->rowShowButton(),
            $this->rowEditButton(),
            $this->rowDeleteButton(),
        ]);
    }

    protected function rowActionsOnlyEditAndDelete(): BaseRenderer
    {
        return Component::make()->setType('operation')->label('操作')->buttons([
            $this->rowEditButton(),
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
            ->title('')
            ->actions([
                Component::make()->type('reset')->label('重置'),
                Component::make()->type('submit')->label('搜索')->level('primary'),
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
        return Form::make()->title('')->mode('horizontal')->redirect($this->getListPath());
    }

    /**
     * @param $id
     *
     * @return Form
     */
    protected function baseDetail($id): Form
    {
        return Form::make()->mode('horizontal')->wrapWithPanel(false)->initApi($this->getShowGetDataPath($id));
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
