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
                amis()->TableColumn('title', '名称')->searchable(),
                amis()->TableColumn('sign', '标识')->searchable(),
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
            amis()->TextControl('title', '名称')->required(),
            amis()->TextControl('sign', '标识')->required(),
            amis()->SubFormControl('page', '页面结构')->form(
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
