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

    protected string $pageTitle = '菜单';

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
            ->expandConfig(['expand' => 'all'])
            ->filterTogglable(false)
            ->footerToolbar(['statistics'])
            ->bulkActions([$this->bulkDeleteButton()->reload('window')])
            ->columns([
                Column::make()->label('ID')->name('id')->sortable(true),
                Column::make()->label('名称')->name('title'),
                Column::make()->label('图标')->name('icon')->type('flex')->justify('start')->items([
                    Html::make()->html('<i class="${icon} mr-2"></i>'),
                    '${icon}',
                ]),
                Column::make()->label('链接')->name('url'),
                Column::make()->label('可见')->name('visible')->type('status'),
                Column::make()->label('创建时间')->name('created_at')->type('datetime')->sortable(true),
                $this->rowActionsOnlyEditAndDelete(),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            Group::make()->body([
                InputText::make()->name('title')->label('名称')->required(true),
                InputText::make()
                    ->name('icon')
                    ->label('图标')
                    ->required(true)
                    ->placeholder('eg: fa fa-xxx')
                    ->description('可以使用<a href="https://fontawesome.com/search?m=free" target="_blank">Font Awesome</a>图标'),
            ]),
            Group::make()->body([
                TreeSelect::make()
                    ->name('parent_id')
                    ->label('父级')
                    ->labelField('title')
                    ->valueField('id')
                    ->value(0)
                    ->options($this->service->getTree()),
                InputNumber::make()
                    ->name('order')
                    ->label('排序')
                    ->required(true)
                    ->labelRemark('大的在前')
                    ->displayMode('enhance')
                    ->min(0)
                    ->value(0),
            ]),
            InputText::make()->name('url')->label('链接')->required(true)->placeholder('eg: /admin_menus'),
            ListSelect::make()
                ->name('url_type')
                ->label('类型')
                ->options(AdminMenu::getType())
                ->value(AdminMenu::TYPE_ROUTE),
            InputText::make()
                ->name('api')
                ->label('页面Api')
                ->required(true)
                ->labelRemark('schemaApi, 页面初始化请求的api, 需要与Controller中的queryPath一致'),
            InputSwitch::make()->name('visible')->label('是否可见')->onText('可见')->offText('不可见')->value(1),
            InputText::make()->name('class_name')->label('类名')->labelRemark('菜单的CSS类名, 一般用于自定义样式'),
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
}
