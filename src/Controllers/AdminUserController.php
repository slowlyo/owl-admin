<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Tag;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Column;
use Slowlyo\SlowAdmin\Renderers\Form\Form;
use Slowlyo\SlowAdmin\Renderers\Form\Select;
use Slowlyo\SlowAdmin\Renderers\Form\InputText;
use Slowlyo\SlowAdmin\Services\AdminUserService;
use Slowlyo\SlowAdmin\Services\AdminRoleService;
use Slowlyo\SlowAdmin\Renderers\Form\InputImage;
use Illuminate\Http\Resources\Json\JsonResource;
use Slowlyo\SlowAdmin\Renderers\Form\InputPassword;

class AdminUserController extends AdminController
{
    protected string $serviceName = AdminUserService::class;

    protected string $queryPath = 'admin_users';

    protected string $pageTitle = '管理员';

    public function index(Request $request): JsonResponse|JsonResource
    {
        if ($this->actionOfGetData()) {
            $keyword = $request->keyword;

            $query = $this->service
                ->query()
                ->with('roles')
                ->when($keyword, function ($query) use ($keyword) {
                    $query->where('username', 'like', "%{$keyword}%")->orWhere('name', 'like', "%{$keyword}%");
                });

            $items = $query->paginate($request->input('perPage', 20))->items();
            $total = $query->count();

            return $this->response()->success(compact('items', 'total'));
        }

        return $this->response()->success($this->list());
    }

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->filter($this->baseFilter()->body(
                InputText::make()->name('keyword')->label('关键字')->size('md')->placeholder('搜索用户名/名称')
            ))
            ->columns([
                Column::make()->label('ID')->name('id')->sortable(true),
                Column::make()->label('头像')->name('avatar')->type('avatar')->src('${avatar}'),
                Column::make()->label('用户名')->name('username'),
                Column::make()->label('名称')->name('name'),
                Column::make()->label('角色')->name('roles')->type('each')->items(
                    Tag::make()->label('${name}')->className('my-1')
                ),
                Column::make()->label('创建时间')->name('created_at')->type('datetime')->sortable(true),
                amis('operation')->label('操作')->buttons([
                    $this->rowEditButton(),
                    $this->rowDeleteButton()->visibleOn('${id != 1}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            InputImage::make()->label('头像')->name('avatar')->receiver($this->uploadImagePath()),
            InputText::make()->label('用户名')->name('username')->required(),
            InputText::make()->label('名称')->name('name')->required(),
            InputPassword::make()->label('密码')->name('password'),
            InputPassword::make()
                ->label('确认密码')
                ->name('confirm_password'),
            Select::make()
                ->name('roles')
                ->label('角色')
                ->searchable(true)
                ->multiple(true)
                ->labelField('name')
                ->valueField('id')
                ->joinValues(false)
                ->extractValue(true)
                ->options(AdminRoleService::make()->query()->get(['id', 'name'])),
        ]);
    }

    public function detail($id): Form
    {
        return $this->baseDetail($id)->body([]);
    }
}
