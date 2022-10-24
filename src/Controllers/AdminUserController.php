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

    protected string $pageTitle;

    public function __construct()
    {
        $this->pageTitle = __('admin.admin_users');

        parent::__construct();
    }

    public function index(Request $request): JsonResponse|JsonResource
    {
        if ($this->actionOfGetData()) {
            $keyword = $request->keyword;

            $query = $this->service
                ->query()
                ->with('roles')
                ->select(['id', 'name', 'username', 'avatar', 'created_at'])
                ->when($keyword, function ($query) use ($keyword) {
                    $query->where('username', 'like', "%{$keyword}%")->orWhere('name', 'like', "%{$keyword}%");
                });

            $items = (clone $query)->paginate($request->input('perPage', 20))->items();
            $total = (clone $query)->count();

            return $this->response()->success(compact('items', 'total'));
        }

        return $this->response()->success($this->list());
    }

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->filter($this->baseFilter()->body(
                InputText::make()
                    ->name('keyword')
                    ->label(__('admin.keyword'))
                    ->size('md')
                    ->placeholder(__('admin.admin_user.search_username'))
            ))
            ->columns([
                Column::make()->label('ID')->name('id')->sortable(true),
                Column::make()->label(__('admin.admin_user.avatar'))->name('avatar')->type('avatar')->src('${avatar}'),
                Column::make()->label(__('admin.username'))->name('username'),
                Column::make()->label(__('admin.admin_user.name'))->name('name'),
                Column::make()->label(__('admin.admin_user.roles'))->name('roles')->type('each')->items(
                    Tag::make()->label('${name}')->className('my-1')
                ),
                Column::make()->label(__('admin.created_at'))->name('created_at')->type('datetime')->sortable(true),
                amis('operation')->label(__('admin.actions'))->buttons([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->visibleOn('${id != 1}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            InputImage::make()
                ->label(__('admin.admin_user.avatar'))
                ->name('avatar')
                ->receiver($this->uploadImagePath()),
            InputText::make()->label(__('admin.username'))->name('username')->required(true),
            InputText::make()->label(__('admin.admin_user.name'))->name('name')->required(true),
            InputPassword::make()->label(__('admin.password'))->name('password'),
            InputPassword::make()
                ->label(__('admin.confirm_password'))
                ->name('confirm_password'),
            Select::make()
                ->name('roles')
                ->label(__('admin.admin_user.roles'))
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
