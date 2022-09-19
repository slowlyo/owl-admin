<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Slowlyo\SlowAdmin\Renderers\Tag;
use Slowlyo\SlowAdmin\Renderers\Page;
use Slowlyo\SlowAdmin\Renderers\Column;
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
        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->expandConfig(['expand' => 'all'])
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
}
