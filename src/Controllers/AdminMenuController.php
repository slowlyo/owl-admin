<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Html;
use Slowlyo\SlowAdmin\Renderers\Column;
use Slowlyo\SlowAdmin\Models\AdminMenu;
use Slowlyo\SlowAdmin\Renderers\Form\Form;
use Slowlyo\SlowAdmin\Renderers\Form\Group;
use Slowlyo\SlowAdmin\Renderers\Form\InputText;
use Slowlyo\SlowAdmin\Services\AdminMenuService;
use Illuminate\Http\Resources\Json\JsonResource;
use Slowlyo\SlowAdmin\Renderers\Form\ListSelect;
use Slowlyo\SlowAdmin\Renderers\Form\TreeSelect;
use Slowlyo\SlowAdmin\Renderers\Form\InputSwitch;
use Slowlyo\SlowAdmin\Renderers\Form\InputNumber;

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
            $items = $this->service->getTree();
            $total = $this->service->query()->count();

            return $this->response()->success(compact('items', 'total'));
        }

        return $this->response()->success($this->list());
    }

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([
                $this->createButton(true)->dialog(
                    amis('dialog')->title(__('admin.create'))->body(
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
                Column::make()->label('ID')->name('id')->sortable(true),
                Column::make()->label(__('admin.admin_menu.title'))->name('title'),
                Column::make()
                    ->label(__('admin.admin_menu.icon'))
                    ->name('icon')
                    ->type('flex')
                    ->justify('start')
                    ->items([
                        Html::make()->html('<i class="${icon} mr-2"></i>'),
                        '${icon}',
                    ]),
                Column::make()->label(__('admin.admin_menu.url'))->name('url'),
                Column::make()->label(__('admin.admin_menu.order'))->name('order')->quickEdit(
                    InputNumber::make()->min(0)
                ),
                Column::make()->label(__('admin.admin_menu.visible'))->name('visible')->type('status'),
                Column::make()->label(__('admin.created_at'))->name('created_at')->type('datetime')->sortable(true),
                amis('operation')->label(__('admin.actions'))->buttons([
                    $this->rowEditButton(true)->dialog(
                        amis('dialog')->title(__('admin.edit'))->body(
                            $this->form()
                                ->api($this->getUpdatePath('$id'))
                                ->initApi($this->getEditGetDataPath('$id'))
                        )->size('lg')
                    ),
                    $this->rowDeleteButton(),
                ]),
            ])->expandConfig(['expand' => 'all']);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            Group::make()->body([
                InputText::make()->name('title')->label(__('admin.admin_menu.title'))->required(true),
                InputText::make()
                    ->name('icon')
                    ->label(__('admin.admin_menu.icon'))
                    ->placeholder('eg: fa fa-xxx')
                    ->description(
                        __('admin.admin_menu.icon_description') .
                        '<a href="https://fontawesome.com/search?m=free" target="_blank">Font Awesome</a>'
                    ),
            ]),
            Group::make()->body([
                TreeSelect::make()
                    ->name('parent_id')
                    ->label(__('admin.admin_menu.parent_id'))
                    ->labelField('title')
                    ->valueField('id')
                    ->value(0)
                    ->options($this->service->getTree()),
                InputNumber::make()
                    ->name('order')
                    ->label(__('admin.admin_menu.order'))
                    ->required(true)
                    ->labelRemark(__('admin.order_desc'))
                    ->displayMode('enhance')
                    ->min(0)
                    ->value(0),
            ]),
            InputText::make()
                ->name('url')
                ->label(__('admin.admin_menu.url'))
                ->required(true)
                ->placeholder('eg: /admin_menus'),
            ListSelect::make()
                ->name('url_type')
                ->label(__('admin.admin_menu.type'))
                ->options(AdminMenu::getType())
                ->value(AdminMenu::TYPE_ROUTE),
            InputText::make()
                ->name('api')
                ->label(__('admin.admin_menu.api'))
                ->required(true)
                ->labelRemark(__('admin.admin_menu.api_description')),
            InputSwitch::make()
                ->name('visible')
                ->label(__('admin.admin_menu.visible'))
                ->onText(__('admin.admin_menu.show'))
                ->offText(__('admin.admin_menu.hide'))
                ->value(1),
            InputText::make()
                ->name('class_name')
                ->label(__('admin.admin_menu.class_name'))
                ->labelRemark(__('admin.admin_menu.class_name_description')),
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
