<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;

/**
 * 代码生成器配置管理 Trait
 * 
 * 负责配置管理相关功能，包括：
 * - 组件属性配置管理
 * - 字段配置管理
 * - 表单数据处理
 * - 编辑数据处理
 */
trait CodeGeneratorConfigTrait
{
    /**
     * 获取组件属性选项
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     * @throws \ReflectionException
     */
    public function getPropertyOptions(Request $request)
    {
        if (blank($request->c)) {
            return $this->response()->success([]);
        }

        $className = '\\Slowlyo\\OwlAdmin\\Renderers\\' . $request->c;

        $renderer = new \ReflectionClass($className);

        $exclude = ['__construct', '__call', 'set', 'jsonSerialize', 'toJson', 'toArray', 'name', 'label',];

        $options = collect($renderer->getMethods(\ReflectionMethod::IS_PUBLIC))
            ->map(function ($item) {
                $_doc = $item->getDocComment();
                $_doc = $_doc ? trim(str_replace(['/**', '*/', '*'], '', $_doc)) : false;

                return ['name' => $item->name, 'comment' => $_doc];
            })
            ->filter(fn($item) => !in_array($item['name'], $exclude))
            ->map(fn($item) => [
                'label' => $item['name'],
                'value' => $item['name'],
            ])
            ->values()
            ->toArray();

        return $this->response()->success(['component_property_options' => $options]);
    }

    /**
     * 保存组件配置
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function saveComponentProperty(Request $request)
    {
        admin_abort_if(!data_get($request->value, 'key'), admin_trans('admin.required', ['attribute' => admin_trans('admin.admin_menu.component')]));

        $list = [];

        if ($original = settings()->get($request->key)) {
            foreach ($original as $item) {
                $list[$item['key'] . '|' . $item['label']] = $item;
            }
        }

        $list[$request->value['key'] . '|' . $request->value['label']] = $request->value;

        $res = settings()->set($request->key, array_values($list));

        return $this->autoResponse($res, admin_trans('admin.save'));
    }

    /**
     * 获取组件配置
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function getComponentProperty(Request $request)
    {
        $component_property_list = collect(settings()->get($request->key))->values();

        return $this->response()->success(compact('component_property_list'));
    }

    /**
     * 删除组件配置
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function delComponentProperty(Request $request)
    {
        $list = settings()->get($request->name);

        if (blank($list)) {
            return $this->autoResponse(false);
        }

        foreach ($list as $key => $item) {
            if ($item['label'] == $request->label && $item['key'] == $request->key) {
                unset($list[$key]);
            }
        }

        settings()->set($request->name, array_values($list));

        return $this->autoResponse(true);
    }

    /**
     * 保存字段配置
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function saveColumnProperty(Request $request)
    {
        $value = collect($request->input('value'))->firstWhere('name', $request->column);
        $list  = settings()->get('admin_common_field', []);

        $list[$request->name] = Arr::except($value, ['component_property_options']);;

        $res = settings()->set('admin_common_field', $list);

        return $this->autoResponse($res, admin_trans('admin.save'));
    }

    /**
     * 获取字段配置
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function getColumnProperty(Request $request)
    {
        $common_field_list = collect(settings()->get('admin_common_field'))->map(fn($v, $k) => [
            'name'        => $k,
            'column_name' => $v['name'],
            'value'       => $v,
        ])->values();

        return $this->response()->success(compact('common_field_list'));
    }

    /**
     * 删除字段配置
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function delColumnProperty(Request $request)
    {
        $list = settings()->get('admin_common_field');

        if (blank($list)) {
            return $this->autoResponse(false);
        }

        foreach ($list as $key => $item) {
            if ($key == $request->name) {
                unset($list[$key]);
            }
        }

        settings()->set('admin_common_field', $list);

        return $this->autoResponse(true);
    }

    /**
     * 获取表单数据
     *
     * @param bool $directReturn 是否直接返回数据
     * @return array|\Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function formData($directReturn = false)
    {
        $databaseColumns = Generator::make()->getDatabaseColumns();
        $defaultPath = $this->service->getDefaultPath();
        $savePaths = $this->buildSavePathOptions($defaultPath);
        $existsTables = $this->buildExistsTablesOptions($databaseColumns);

        $data = [
            'table_info'         => $databaseColumns,
            'table_primary_keys' => Generator::make()->getDatabasePrimaryKeys(),
            'default_path'       => $defaultPath,
            'model_path'         => $defaultPath['value']['model_path'],
            'service_path'       => $defaultPath['value']['service_path'],
            'controller_path'    => $defaultPath['value']['controller_path'],
            'exists_tables'      => $existsTables,
            'menu_tree'          => AdminMenuService::make()->getTree(),
            'save_path_options'  => $savePaths,
            'component_options'  => $this->service->getComponentOptions(),
        ];

        if ($directReturn) {
            return $data;
        }

        return $this->response()->success($data);
    }

    /**
     * 构建保存路径选项
     *
     * @param array $defaultPath
     * @return array
     */
    protected function buildSavePathOptions($defaultPath)
    {
        $savePaths = [$defaultPath];
        
        foreach (Admin::extension()->all() as $extension) {
            $property    = $extension->composerProperty;
            $namespace   = str_replace('\\', "/", array_key_first($property->get('autoload.psr-4')));
            $alias       = $extension->getAlias();
            
            $savePaths[] = [
                'label' => admin_trans("admin.code_generators.save_path_label_prefix") . (empty($alias) ? $extension->getName() : $alias),
                'value' => [
                    'controller_path' => $namespace . 'Http/Controllers/',
                    'service_path'    => $namespace . 'Services/',
                    'model_path'      => $namespace . 'Models/',
                ],
            ];
        }

        return $savePaths;
    }

    /**
     * 构建现有表选项
     *
     * @param \Illuminate\Support\Collection $databaseColumns
     * @return \Illuminate\Support\Collection
     */
    protected function buildExistsTablesOptions($databaseColumns)
    {
        return $databaseColumns->map(function ($item, $index) {
            return [
                'label'    => $index,
                'children' => collect($item)->keys()->map(function ($item) use ($index) {
                    return ['value' => $item . '-' . $index, 'label' => $item];
                }),
            ];
        })->values();
    }

    /**
     * 编辑数据处理
     *
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function edit($id)
    {
        if ($this->actionOfGetData()) {
            $data = $this->service->getEditData($id)->toArray();
            $data = array_merge($data, $this->formData(true));

            return $this->response()->success($data);
        }

        return parent::edit($id);
    }
}
