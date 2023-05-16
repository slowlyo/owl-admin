<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Slowlyo\OwlAdmin\Renderers\Tag;
use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Models\AdminMenu;
use Slowlyo\OwlAdmin\Models\AdminPermission;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Services\AdminPermissionService;

/**
 * @property AdminPermissionService $service
 */
class AdminPermissionController extends AdminController
{
    protected string $serviceName = AdminPermissionService::class;

    public function list(): Page
    {
        $autoBtn = '';
        if (config('admin.show_auto_generate_permission_button')) {
            $autoBtn = amisMake()->AjaxAction()
                ->label(__('admin.admin_permission.auto_generate'))
                ->level('success')
                ->confirmText(__('admin.admin_permission.auto_generate_confirm'))
                ->api(admin_url('system/_admin_permissions_auto_generate'));
        }

        $crud = $this->baseCRUD()
            ->loadDataOnce()
            ->filterTogglable(false)
            ->footerToolbar([])
            ->headerToolbar([
                $this->createButton(true, 'lg'),
                'bulkActions',
                $autoBtn,
                amis('reload')->align('right'),
                amis('filter-toggler')->align('right'),
            ])
            ->columns([
                amisMake()->TableColumn('id', 'ID')->sortable(),
                amisMake()->TableColumn('name', __('admin.admin_permission.name')),
                amisMake()->TableColumn('slug', __('admin.admin_permission.slug')),
                amisMake()->TableColumn('http_method', __('admin.admin_permission.http_method'))
                    ->type('each')
                    ->items(
                        Tag::make()->label('${item}')->className('my-1')
                    )
                    ->placeholder(Tag::make()->label('ANY')),
                amisMake()->TableColumn('http_path', __('admin.admin_permission.http_path'))
                    ->type('each')
                    ->items(
                        Tag::make()->label('${item}')->className('my-1')
                    ),
                $this->rowActionsOnlyEditAndDelete(true, 'lg'),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            amisMake()->TextControl('name', __('admin.admin_permission.name'))->required(),
            amisMake()->TextControl('slug', __('admin.admin_permission.slug'))->required(),
            amisMake()->TreeSelectControl('parent_id', __('admin.parent'))
                ->labelField('name')
                ->valueField('id')
                ->value(0)
                ->options($this->service->getTree()),
            amisMake()->CheckboxesControl('http_method', __('admin.admin_permission.http_method'))
                ->options($this->getHttpMethods())
                ->description(__('admin.admin_permission.http_method_description'))
                ->joinValues(false)
                ->extractValue(),
            amisMake()->NumberControl('order', __('admin.order'))
                ->required()
                ->labelRemark(__('admin.order_desc'))
                ->displayMode('enhance')
                ->min(0)
                ->value(0),
            amisMake()->SelectControl('http_path', __('admin.admin_permission.http_path'))
                ->searchable()
                ->multiple()
                ->options($this->getRoutes())
                ->autoCheckChildren(false)
                ->joinValues(false)
                ->extractValue(),
            amisMake()->TreeSelectControl('menus', __('admin.menus'))
                ->searchable()
                ->multiple()
                ->showIcon(false)
                ->options(AdminMenuService::make()->getTree())
                ->labelField('title')
                ->valueField('id')
                ->autoCheckChildren(false)
                ->joinValues(false)
                ->extractValue(),
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }

    private function getHttpMethods(): array
    {
        return collect(AdminPermission::$httpMethods)->map(fn($method) => [
            'value' => $method,
            'label' => $method,
        ])->toArray();
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
            $_httpPath = $menu['url_type'] == AdminMenu::TYPE_ROUTE ? $this->getHttpPath($menu['url']) : '';

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

        AdminPermission::query()->truncate();
        AdminPermission::query()->insert($permissions);

        DB::table('admin_permission_menu')->truncate();
        foreach ($permissions as $item) {
            $query = DB::table('admin_permission_menu');
            $query->insert([
                'permission_id' => $item['id'],
                'menu_id'       => $item['id'],
            ]);

            $_id = $item['id'];
            while ($item['parent_id'] != 0) {
                (clone $query)->insert([
                    'permission_id' => $_id,
                    'menu_id'       => $item['parent_id'],
                ]);

                $item = AdminMenu::query()->find($item['parent_id']);
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
