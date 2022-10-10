<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Slowlyo\SlowAdmin\Renderers\Tag;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Column;
use Slowlyo\SlowAdmin\Renderers\Action;
use Slowlyo\SlowAdmin\Models\AdminMenu;
use Slowlyo\SlowAdmin\Renderers\Form\Form;
use Slowlyo\SlowAdmin\Renderers\Form\Select;
use Slowlyo\SlowAdmin\Models\AdminPermission;
use Slowlyo\SlowAdmin\Renderers\Form\InputText;
use Slowlyo\SlowAdmin\Renderers\Form\Checkboxes;
use Slowlyo\SlowAdmin\Renderers\Form\TreeSelect;
use Slowlyo\SlowAdmin\Services\AdminMenuService;
use Illuminate\Http\Resources\Json\JsonResource;
use Slowlyo\SlowAdmin\Renderers\Form\InputNumber;
use Slowlyo\SlowAdmin\Services\AdminPermissionService;

class AdminPermissionController extends AdminController
{
    protected string $serviceName = AdminPermissionService::class;

    protected string $queryPath = 'admin_permissions';

    protected string $pageTitle = '权限';

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
        $autoBtn = '';
        if (config('admin.show_auto_generate_permission_button')) {
            $autoBtn = Action::make()
                ->label('自动生成')
                ->level('success')
                ->confirmText('权限信息会在 截断权限表&权限菜单关联表 后重新生成, 是否继续操作 ?')
                ->actionType('ajax')
                ->api(admin_url('_admin_permissions_auto_generate'))
                ->align('right');
        }

        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->expandConfig(['expand' => 'all'])
            ->headerToolbar([
                'filter-toggler',
                'bulkActions',
                amis('reload')->align('right'),
                $autoBtn,
            ])
            ->columns([
                Column::make()->label('ID')->name('id')->sortable(true),
                Column::make()->label('名称')->name('name'),
                Column::make()->label('标识')->name('slug'),
                Column::make()->label('请求方式')->name('http_method')->type('each')->items(Tag::make()
                    ->label('${item}')
                    ->className('my-1'))
                    ->placeholder(Tag::make()->label('ANY')),
                Column::make()->label('路由')->name('http_path')->type('each')->items(Tag::make()
                    ->label('${item}')
                    ->className('my-1')),
                $this->rowActionsOnlyEditAndDelete(true),
            ]);

        return $this->baseList($crud)->toolbar([$this->createButton(true)]);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            InputText::make()->name('name')->label('名称')->required(true),
            InputText::make()->name('slug')->label('标识')->required(true),
            TreeSelect::make()
                ->name('parent_id')
                ->label('父级')
                ->labelField('name')
                ->valueField('id')
                ->value(0)
                ->options($this->service->getTree()),
            Checkboxes::make()
                ->name('http_method')
                ->label('请求方式')
                ->options($this->getHttpMethods())
                ->description('不选则为ANY')
                ->joinValues(false)
                ->extractValue(true),
            InputNumber::make()
                ->name('order')
                ->label('排序')
                ->required(true)
                ->labelRemark('大的在前')
                ->displayMode('enhance')
                ->min(0)
                ->value(0),
            Select::make()
                ->name('http_path')
                ->label('路由')
                ->searchable(true)
                ->multiple(true)
                ->options($this->getRoutes())
                ->autoCheckChildren(false)
                ->joinValues(false)
                ->extractValue(true),
            TreeSelect::make()
                ->name('menus')
                ->label('菜单')
                ->searchable(true)
                ->multiple(true)
                ->options(AdminMenuService::make()->getTree())
                ->labelField('title')
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

    private function getHttpMethods(): array
    {

        return collect(AdminPermission::$httpMethods)->map(function ($method) {
            return [
                'value' => $method,
                'label' => $method,
            ];
        })->toArray();
    }

    public function getRoutes(): array
    {
        $prefix = (string)config('admin.route.prefix');

        $container = collect();
        return collect(app('router')->getRoutes())->map(function ($route) use ($prefix, $container) {
            if (!Str::startsWith($uri = $route->uri(), $prefix) && $prefix && $prefix !== '/') {
                return null;
            }
            if (!Str::contains($uri, '{')) {
                if ($prefix !== '/') {
                    $route = Str::replaceFirst($prefix, '', $uri . '*');
                } else {
                    $route = $uri . '*';
                }

                $route !== '*' && $container->push($route);
            }
            $path = preg_replace('/{.*}+/', '*', $uri);
            $prefix !== '/' && $path = Str::replaceFirst($prefix, '', $path);

            return $path;
        })->merge($container)->filter()->unique()->map(function ($method) {
            return [
                'value' => $method,
                'label' => $method,
            ];
        })->values()->all();
    }

    public function autoGenerate()
    {
        $menus = AdminMenu::all()->toArray();

        $permissions = [];
        foreach ($menus as $menu) {
            $_httpPath = $this->getHttpPath($menu['api']);

            $permissions[] = [
                'id'         => $menu['id'],
                'name'       => $menu['title'],
                'slug'       => (string)Str::uuid(),
                'http_path'  => json_encode($_httpPath ? [$_httpPath] : ''),
                'order'      => $menu['order'],
                'parent_id'  => $menu['parent_id'],
                'created_at' => $menu['created_at'],
                'updated_at' => $menu['updated_at'],
            ];
        }

        AdminPermission::truncate();
        AdminPermission::insert($permissions);

        DB::table('admin_permission_menu')->truncate();
        foreach ($permissions as $item) {
            $query = DB::table('admin_permission_menu');
            $query->insert([
                'permission_id' => $item['id'],
                'menu_id'       => $item['id'],
            ]);
            if ($item['parent_id'] != 0) {
                $query->insert([
                    'permission_id' => $item['id'],
                    'menu_id'       => $item['parent_id'],
                ]);
            }
        }

        return $this->response()->success('自动生成成功');
    }

    private function getHttpPath($uri)
    {
        $excepts = ['/', '', '-'];
        if (in_array($uri, $excepts)) {
            return '';
        }

        if (!str_starts_with($uri, '/')) {
            $uri = '/' . $uri;
        }

        return $uri . '*';
    }
}
