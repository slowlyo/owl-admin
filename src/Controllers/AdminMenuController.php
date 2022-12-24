<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Html;
use Slowlyo\SlowAdmin\Renderers\Form;
use Slowlyo\SlowAdmin\Models\AdminMenu;
use Slowlyo\SlowAdmin\Renderers\Dialog;
use Slowlyo\SlowAdmin\Renderers\Operation;
use Slowlyo\SlowAdmin\Renderers\TableColumn;
use Slowlyo\SlowAdmin\Renderers\TextControl;
use Slowlyo\SlowAdmin\Renderers\ListControl;
use Slowlyo\SlowAdmin\Renderers\GroupControl;
use Slowlyo\SlowAdmin\Renderers\NumberControl;
use Slowlyo\SlowAdmin\Renderers\SwitchControl;
use Slowlyo\SlowAdmin\Services\AdminMenuService;
use Illuminate\Http\Resources\Json\JsonResource;
use Slowlyo\SlowAdmin\Renderers\TreeSelectControl;

class AdminMenuController extends AdminController
{
    protected string $serviceName = AdminMenuService::class;

    protected string $queryPath = 'admin_menus';

    protected string $pageTitle;

    public function __construct()
    {
        $this->pageTitle = __('admin.admin_menus');

        parent::__construct();
    }

    public function index(): JsonResponse|JsonResource
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->list());
        }

        return $this->response()->success($this->list());
    }

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->loadDataOnce(true)
            ->footerToolbar([])
            ->headerToolbar([
                $this->createButton(true)->dialog(
                    Dialog::make()->title(__('admin.create'))->body(
                        $this->form()->api($this->getStorePath())
                    )->size('lg')
                ),
                'bulkActions',
                amis('reload')->align('right'),
                amis('filter-toggler')->align('right'),
            ])
            ->filterTogglable(false)
            ->footerToolbar(['statistics'])
            ->quickSaveApi(admin_url('admin_menu_quick_save'))
            ->bulkActions([$this->bulkDeleteButton()->reload('window')])
            ->columns([
                TableColumn::make()->label('ID')->name('id')->sortable(true),
                TableColumn::make()->label(__('admin.admin_menu.title'))->name('title'),
                TableColumn::make()
                    ->label(__('admin.admin_menu.icon'))
                    ->name('icon')
                    ->type('flex')
                    ->justify('start')
                    ->items([
                        Html::make()->html('<i class="${icon} mr-2"></i>'),
                        '${icon}',
                    ]),
                TableColumn::make()->label(__('admin.admin_menu.url'))->name('url'),
                TableColumn::make()->label(__('admin.admin_menu.order'))->name('order')->quickEdit(
                    NumberControl::make()->min(0)
                ),
                TableColumn::make()->label(__('admin.admin_menu.visible'))->name('visible')->type('status'),
                TableColumn::make()
                    ->label(__('admin.created_at'))
                    ->name('created_at')
                    ->type('datetime')
                    ->sortable(true),
                Operation::make()->label(__('admin.actions'))->buttons([
                    $this->rowEditButton(true)->dialog(
                        Dialog::make()->title(__('admin.edit'))->body(
                            $this->form()
                                ->api($this->getUpdatePath('$id'))
                                ->initApi($this->getEditGetDataPath('$id'))
                        )->size('lg')
                    ),
                    $this->rowDeleteButton(),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            GroupControl::make()->body([
                TextControl::make()->name('title')->label(__('admin.admin_menu.title'))->required(true),
                TextControl::make()
                    ->name('icon')
                    ->label(__('admin.admin_menu.icon'))
                    ->placeholder('eg: fa fa-xxx')
                    ->description(
                        __('admin.admin_menu.icon_description') .
                        '<a href="https://fontawesome.com/search?m=free" target="_blank">Font Awesome</a>'
                    ),
            ]),
            GroupControl::make()->body([
                TreeSelectControl::make()
                    ->name('parent_id')
                    ->label(__('admin.admin_menu.parent_id'))
                    ->labelField('title')
                    ->valueField('id')
                    ->value(0)
                    ->options($this->service->getTree()),
                NumberControl::make()
                    ->name('order')
                    ->label(__('admin.admin_menu.order'))
                    ->required(true)
                    ->labelRemark(__('admin.order_desc'))
                    ->displayMode('enhance')
                    ->min(0)
                    ->value(0),
            ]),
            TextControl::make()
                ->name('url')
                ->label(__('admin.admin_menu.url'))
                ->required(true)
                ->placeholder('eg: /admin_menus'),
            ListControl::make()
                ->name('url_type')
                ->label(__('admin.admin_menu.type'))
                ->options(AdminMenu::getType())
                ->value(AdminMenu::TYPE_ROUTE),
            SwitchControl::make()
                ->name('visible')
                ->label(__('admin.admin_menu.visible'))
                ->onText(__('admin.admin_menu.show'))
                ->offText(__('admin.admin_menu.hide'))
                ->value(1),
        ])->onEvent([
            'submitSucc' => [
                'actions' => [
                    'actionType' => 'custom',
                    'script'     => 'setTimeout(()=>(window.location.reload()), 1200)',
                ],
            ],
        ]);
    }

    public function detail($id): Form
    {
        return $this->baseDetail($id)->body([]);
    }

    public function quickEdit()
    {
        $data = request()->rows;

        foreach ($data as $item) {
            $this->service->update($item['id'], $item);
        }

        return $this->autoResponse(true);
    }
}
