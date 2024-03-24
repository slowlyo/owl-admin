<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Slowlyo\OwlAdmin\Services\AdminPageService;
use Slowlyo\OwlAdmin\Controllers\AdminController;

class PagesController extends AdminController
{
    protected string $serviceName = AdminPageService::class;

    public function list()
    {
        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->headerToolbar([
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('title', __('admin.pages.title'))->searchable(),
                amis()->TableColumn('sign', __('admin.pages.sign'))->searchable(),
                amis()->TableColumn('updated_at', __('admin.created_at'))->type('datetime')->sortable(true),
                $this->rowActions([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton(),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form()
    {
        return $this->baseForm()->body([
            amis()->TextControl('title', __('admin.pages.title'))->required(),
            amis()->TextControl('sign', __('admin.pages.sign'))->required(),
            amis()->SubFormControl('page', __('admin.pages.page'))->form(
                amis()->Form()->className('h-full')->set('size', 'full')->title('')->body(
                    amis('custom-amis-editor')
                        ->name('schema')
                        ->label('')
                        ->mode('normal')
                        ->className('h-full')
                )
            )->required(),
        ]);
    }


    public function detail($id)
    {
        return $this->baseDetail()->body([]);
    }
}
