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

    protected string $pageTitle;

    public function __construct()
    {
        $this->pageTitle = __('admin.admin_permissions');

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
        $autoBtn = '';
        if (config('admin.show_auto_generate_permission_button')) {
            $autoBtn = Action::make()
                ->label(__('admin.admin_permission.auto_generate'))
                ->level('success')
                ->confirmText(__('admin.admin_permission.auto_generate_confirm'))
                ->actionType('ajax')
                ->api(admin_url('_admin_permissions_auto_generate'));
        }

        $crud = $this->baseCRUD()
            ->loadDataOnce(true)
            ->filterTogglable(false)
            ->footerToolbar([])
            ->headerToolbar([
                $this->createButton(true),
                'bulkActions',
                $autoBtn,
                amis('reload')->align('right'),
                amis('filter-toggler')->align('right'),
            ])
            ->columns([
                Column::make()->label('ID')->name('id')->sortable(true),
                Column::make()->label(__('admin.admin_permission.name'))->name('name'),
                Column::make()->label(__('admin.admin_permission.slug'))->name('slug'),
                Column::make()
                    ->label(__('admin.admin_permission.http_method'))
                    ->name('http_method')
                    ->type('each')
                    ->items(Tag::make()
                        ->label('${item}')
                        ->className('my-1'))
                    ->placeholder(Tag::make()->label('ANY')),
                Column::make()
                    ->label(__('admin.admin_permission.http_path'))
                    ->name('http_path')
                    ->type('each')
                    ->items(Tag::make()
                        ->label('${item}')
                        ->className('my-1')),
                $this->rowActionsOnlyEditAndDelete(true),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            InputText::make()->name('name')->label(__('admin.admin_permission.name'))->required(true),
            InputText::make()->name('slug')->label(__('admin.admin_permission.slug'))->required(true),
            TreeSelect::make()
                ->name('parent_id')
                ->label(__('admin.parent'))
                ->labelField('name')
                ->valueField('id')
                ->value(0)
                ->options($this->service->getTree()),
            Checkboxes::make()
                ->name('http_method')
                ->label(__('admin.admin_permission.http_method'))
                ->options($this->getHttpMethods())
                ->description(__('admin.admin_permission.http_method_description'))
                ->joinValues(false)
                ->extractValue(true),
            InputNumber::make()
                ->name('order')
                ->label(__('admin.order'))
                ->required(true)
                ->labelRemark(__('admin.order_desc'))
                ->displayMode('enhance')
                ->min(0)
                ->value(0),
            Select::make()
                ->name('http_path')
                ->label(__('admin.admin_permission.http_path'))
                ->searchable(true)
                ->multiple(true)
                ->options($this->getRoutes())
                ->autoCheckChildren(false)
                ->joinValues(false)
                ->extractValue(true),
            TreeSelect::make()
                ->name('menus')
                ->label(__('admin.menus'))
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

        return $this->response()->successMessage(
            __('admin.successfully_message', ['attribute' => __('admin.admin_permission.auto_generate')])
        );
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
