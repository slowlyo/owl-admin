<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Column;
use Slowlyo\SlowAdmin\Renderers\Form\Form;
use Slowlyo\SlowAdmin\Renderers\Form\InputText;
use Slowlyo\SlowAdmin\Services\AdminRoleService;
use Slowlyo\SlowAdmin\Renderers\Form\TreeSelect;
use Illuminate\Http\Resources\Json\JsonResource;
use Slowlyo\SlowAdmin\Services\AdminPermissionService;

class AdminRoleController extends AdminController
{
    protected string $serviceName = AdminRoleService::class;

    protected string $queryPath = 'admin_roles';

    protected string $pageTitle = '角色';

    public function index(Request $request): JsonResponse|JsonResource
    {
        if ($this->actionOfGetData()) {
            $items = $this->service
                ->query()
                ->paginate($request->input('perPage', 20))
                ->items();
            $total = $this->service->query()->count();

            return $this->response()->success(compact('items', 'total'));
        }

        return $this->response()->success($this->list());
    }

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->columns([
                Column::make()->label('ID')->name('id')->sortable(true),
                Column::make()->label('名称')->name('name'),
                Column::make()->label('标识')->name('slug')->type('tag'),
                Column::make()->label('创建时间')->name('created_at')->type('datetime')->sortable(true),
                Column::make()->label('更新时间')->name('updated_at')->type('datetime')->sortable(true),
                amis('operation')->label('操作')->buttons([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->visibleOn('${slug != "administrator"}'),
                ]),
            ]);

        return $this->baseList($crud)->toolbar([$this->createButton(true)]);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            InputText::make()->label('名称')->name('name')->required(true),
            InputText::make()->label('标识')->name('slug')->description('角色的唯一标识, 不可重复')->required(true),
            TreeSelect::make()
                ->name('permissions')
                ->label('权限')
                ->searchable(true)
                ->multiple(true)
                ->options(AdminPermissionService::make()->getTree())
                ->labelField('name')
                ->valueField('id')
                ->autoCheckChildren(false)
                ->joinValues(false)
                ->extractValue(true),
        ]);
    }

    public function detail($id): Form
    {
        return $this->baseDetail($id)->body([]);
    }
}
