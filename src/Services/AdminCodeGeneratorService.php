<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionMethod;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Models\AdminCodeGenerator;

/**
 * @method AdminCodeGenerator getModel()
 * @method AdminCodeGenerator|Builder query()
 */
class AdminCodeGeneratorService extends AdminService
{
    protected const COMPONENT_CACHE_PREFIX = 'owl_admin:code_generator:component';

    protected string $modelName = AdminCodeGenerator::class;

    public function listQuery()
    {
        $title = request('title');
        $tableName = request('table_name');

        return parent::listQuery()->when($title, function ($query) use ($title) {
            $query->where('title', 'like', "%{$title}%");
        })->when($tableName, function ($query) use ($tableName) {
            $query->where('table_name', 'like', "%{$tableName}%");
        });
    }

    public function store($data)
    {
        admin_abort_if(
            $this->query()->where('table_name', $data['table_name'])->exists(),
            admin_trans('admin.code_generators.exists_table')
        );

        return parent::store($this->filterData($data));
    }

    public function update($primaryKey, $data)
    {
        $exists = $this->query()
            ->where('table_name', $data['table_name'])
            ->where($this->primaryKey(), '<>', $primaryKey)
            ->exists();

        admin_abort_if($exists, admin_trans('admin.code_generators.exists_table'));

        return parent::update($primaryKey, $this->filterData($data));
    }

    public function filterData($data)
    {
        admin_abort_if(
            !data_get($data, 'columns'),
            admin_trans('admin.required', ['attribute' => admin_trans('admin.code_generators.column_info')])
        );

        admin_abort_if(
            collect($data['columns'])->pluck('name')->unique()->count() != count($data['columns']),
            admin_trans('admin.code_generators.duplicate_column')
        );

        $data['columns'] = collect($data['columns'])
            ->map(fn($item) => Arr::except($item, ['component_options']))
            ->toArray();

        if (in_array('need_create_table', $data['needs'])) {
            $data['needs'][] = 'need_database_migration';
            $data['needs']   = array_unique($data['needs']);
        }

        $data['page_info']['list_display_created_at'] = $data['list_display_created_at'] ?? 1;
        $data['page_info']['list_display_updated_at'] = $data['list_display_updated_at'] ?? 1;

        foreach ($data['columns'] as &$columnItem) {
            if (data_get($columnItem, 'list_component.component_property_options')) {
                unset($columnItem['list_component']['component_property_options']);
            }
            if (data_get($columnItem, 'form_component.component_property_options')) {
                unset($columnItem['form_component']['component_property_options']);
            }
            if (data_get($columnItem, 'detail_component.component_property_options')) {
                unset($columnItem['detail_component']['component_property_options']);
            }
            if (filled(data_get($columnItem, 'list_filter'))) {
                foreach ($columnItem['list_filter'] as &$filterItem) {
                    if (data_get($filterItem, 'filter.component_property_options')) {
                        unset($filterItem['filter']['component_property_options']);
                    }
                }
            }

            $filterInputNames = array_filter(data_get($columnItem, 'list_filter.*.input_name', []));

            if (count($filterInputNames) != count(array_unique($filterInputNames))) {
                admin_abort(admin_trans('admin.code_generators.duplicate_filter_input_name', ['column' => $columnItem['name']]));
            }
        }

        return Arr::except($data, [
            'table_info',
            'table_primary_keys',
            'exists_tables',
            'menu_tree',
            'component_options',
            'save_path_options',
            'default_path',
            'save_path',
        ]);
    }

    /**
     * 获取命名空间
     *
     * @param $name
     * @param $app
     *
     * @return string
     */
    public function getNamespace($name, $app = null): string
    {
        $namespace = collect(explode('\\', Admin::config('admin.route.namespace')));

        $namespace->pop();

        if ($app && !Admin::currentModule()) {
            $namespace->pop();
        }

        return $namespace->push($name)->implode('/') . '/';
    }

    public function getDefaultPath()
    {
        return [
            'label' => Admin::currentModule() ?: admin_trans('admin.code_generators.save_path_dir'),
            'value' => [
                'controller_path' => $this->getNamespace('Controllers'),
                'service_path'    => $this->getNamespace('Services', 1),
                'model_path'      => $this->getNamespace('Models', 1),
            ],
        ];
    }

    /**
     * 获取组件选项。
     *
     * @return array
     */
    public function getComponentOptions()
    {
        return Admin::context()->remember('admin_code_generator.component_options', function () {
            return $this->getComponentNames()
                ->map(function ($component) {
                    $metadata = $this->getCachedComponentMetadata($component);

                    return [
                        'label' => $metadata['label'],
                        'value' => $component,
                    ];
                })
                ->values()
                ->toArray();
        });
    }

    /**
     * 获取组件属性选项。
     *
     * @param string $component
     * @return array
     */
    public function getComponentPropertyOptions(string $component): array
    {
        // 组件名为空时直接返回空数组，避免无意义缓存和反射。
        if (blank($component)) {
            return [];
        }

        return $this->getCachedComponentMetadata($component)['property_options'] ?? [];
    }

    /**
     * 获取组件名称列表。
     *
     * @return Collection
     */
    protected function getComponentNames(): Collection
    {
        return Admin::context()->remember('admin_code_generator.component_names', function () {
            return collect(get_class_methods(amis()))
                ->filter(fn($item) => $item != 'make')
                ->values();
        });
    }

    /**
     * 获取组件缓存后的元数据。
     *
     * @param string $component
     * @return array
     */
    protected function getCachedComponentMetadata(string $component): array
    {
        $contextKey = "admin_code_generator.component_metadata.{$component}";

        return Admin::context()->remember($contextKey, function () use ($component) {
            $cacheKey = $this->getComponentMetadataCacheKey($component);

            return cache()->rememberForever($cacheKey, fn() => $this->buildComponentMetadata($component));
        });
    }

    /**
     * 构建组件元数据。
     *
     * @param string $component
     * @return array
     */
    protected function buildComponentMetadata(string $component): array
    {
        $renderer = new ReflectionClass($this->getRendererClassName($component));
        $doc = $renderer->getDocComment();
        $doc = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", '', $doc ?: '');
        $doc = $doc ? trim(str_replace('文档', '', $doc)) : '';

        return [
            'label' => $doc ? $component . ' - ' . $doc : $component,
            'property_options' => $this->buildComponentPropertyOptions($renderer),
        ];
    }

    /**
     * 构建组件属性选项。
     *
     * @param ReflectionClass $renderer
     * @return array
     */
    protected function buildComponentPropertyOptions(ReflectionClass $renderer): array
    {
        return collect($renderer->getMethods(ReflectionMethod::IS_PUBLIC))
            ->map(fn($item) => $item->name)
            ->filter(fn($item) => !in_array($item, $this->getComponentPropertyExcludeMethods(), true))
            ->map(fn($item) => [
                'label' => $item,
                'value' => $item,
            ])
            ->values()
            ->toArray();
    }

    /**
     * 获取组件属性排除方法。
     *
     * @return array
     */
    protected function getComponentPropertyExcludeMethods(): array
    {
        return ['__construct', '__call', 'set', 'jsonSerialize', 'toJson', 'toArray', 'name', 'label'];
    }

    /**
     * 获取组件类名。
     *
     * @param string $component
     * @return string
     */
    protected function getRendererClassName(string $component): string
    {
        return 'Slowlyo\\OwlAdmin\\Renderers\\' . $component;
    }

    /**
     * 获取组件元数据缓存键。
     *
     * @param string $component
     * @return string
     */
    protected function getComponentMetadataCacheKey(string $component): string
    {
        return self::COMPONENT_CACHE_PREFIX . ':metadata:' . $component . ':' . $this->getRendererCacheVersion($component);
    }

    /**
     * 获取组件缓存版本。
     *
     * @param string $component
     * @return string
     */
    protected function getRendererCacheVersion(string $component): string
    {
        $path = $this->getRendererFilePath($component);

        // 文件不存在时返回固定版本，避免缓存键失控增长。
        if (!is_file($path)) {
            return 'missing';
        }

        return md5($path . '|' . filemtime($path) . '|' . filesize($path));
    }

    /**
     * 获取组件文件路径。
     *
     * @param string $component
     * @return string
     */
    protected function getRendererFilePath(string $component): string
    {
        return dirname(__DIR__) . '/Renderers/' . $component . '.php';
    }

    /**
     * 克隆记录
     *
     * @param $data
     *
     * @return void
     */
    public function clone($data)
    {
        $tableNameExists = $this->query()->where('table_name', $data['table_name'])->exists();

        admin_abort_if($tableNameExists, admin_trans('admin.code_generators.exists_table'));

        $original = $this->query()->find($data['id']);

        $new = $original->replicate();

        $new->table_name = $data['table_name'];
        $new->title      = $data['title'];

        $new->save();
    }
}
