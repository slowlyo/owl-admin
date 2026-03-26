<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Cache\Repository;
use Slowlyo\OwlAdmin\Support\Cores\Database;
use Slowlyo\OwlAdmin\Models\AdminRelationship;

/**
 * @method AdminRelationship getModel()
 * @method AdminRelationship|Builder query()
 */
class AdminRelationshipService extends AdminService
{
    protected string $modelName = AdminRelationship::class;

    public string $cacheKey = 'admin_relationships';

    /**
     * 获取关联列表并追加预览代码。
     *
     * @return mixed
     */
    public function list()
    {
        $list = parent::list();

        collect($list['items'])->transform(function ($item) {
            $item->setAttribute('preview_code', $item->getPreviewCode());
        });

        return $list;
    }

    /**
     * 获取全部关联配置。
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        $payload = $this->normalizeCachePayload($this->cache()->get($this->cacheKey));

        // 命中兼容缓存时直接还原模型集合，减少重复查询。
        if ($payload !== null) {
            return AdminRelationship::hydrate($payload);
        }

        try {
            $payload = $this->query()
                ->get()
                ->map(fn(AdminRelationship $relationship) => $relationship->getAttributes())
                ->values()
                ->all();

            $this->cache()->forever($this->cacheKey, $payload);

            return AdminRelationship::hydrate($payload);
        } catch (\Throwable $e) {
            return new Collection();
        }
    }

    /**
     * 保存前校验关联名称唯一性。
     *
     * @param array $data
     * @param string $primaryKey
     * @return void
     */
    public function saving(&$data, $primaryKey = '')
    {
        $exists = $this->query()
            ->where('model', $data['model'])
            ->where('title', $data['title'])
            ->when($primaryKey, fn($q) => $q->where('id', '<>', $primaryKey))
            ->exists();

        admin_abort_if($exists, admin_trans('admin.relationships.rel_name_exists'));

        $methodExists = method_exists($data['model'], $data['title']);

        admin_abort_if($methodExists, admin_trans('admin.relationships.rel_name_exists'));
    }

    /**
     * 获取关联缓存实例。
     *
     * @return Repository
     */
    private function cache(): Repository
    {
        return cache()->driver('file');
    }

    /**
     * 保存后清理关联缓存。
     *
     * @param mixed $model
     * @param bool $isEdit
     * @return void
     */
    public function saved($model, $isEdit = false)
    {
        $this->cache()->forget($this->cacheKey);
    }

    /**
     * 删除后清理关联缓存。
     *
     * @param mixed $ids
     * @return void
     */
    public function deleted($ids)
    {
        $this->cache()->forget($this->cacheKey);
    }

    /**
     * 获取项目内所有模型。
     *
     * @return array
     */
    public function allModels()
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(app_path('Models')));
        $phpFiles = new \RegexIterator($iterator, '/^.+\.php$/i', \RegexIterator::GET_MATCH);

        foreach ($phpFiles as $phpFile) {
            $filePath = $phpFile[0];
            require_once $filePath;
        }

        $modelDirClass = collect(get_declared_classes())
            ->filter(fn($i) => Str::startsWith($i, 'App\\Models'))
            ->toArray();

        $composer = require base_path('/vendor/autoload.php');
        $classMap = $composer->getClassMap();
        $tables   = Database::getTables();

        $models = collect($classMap)
            ->keys()
            ->filter(fn($item) => str_contains($item, 'Models\\'))
            ->filter(fn($item) => @class_exists($item))
            ->filter(fn($item) => (new \ReflectionClass($item))->isSubclassOf(Model::class) && !(new \ReflectionClass($item))->isAbstract())
            ->merge($modelDirClass)
            ->unique()
            ->filter(fn($item) => in_array(app($item)->getTable(), $tables))
            ->values()
            ->map(fn($item) => [
                'label' => Str::of($item)->explode('\\')->pop(),
                'table' => app($item)->getTable(),
                'value' => $item,
            ]);

        return compact('tables', 'models');
    }

    /**
     * 根据数据表生成模型。
     *
     * @param string $table
     * @return void
     */
    public function generateModel($table)
    {
        $className = Str::of($table)->studly()->singular()->value();

        $template = <<<PHP
<?php

namespace App\Models;

use Slowlyo\OwlAdmin\Models\BaseModel as Model;

class $className extends Model
{
    protected \$table = '$table';
}
PHP;

        $path = app_path("Models/$className.php");

        admin_abort_if(file_exists($path), admin_trans('admin.relationships.model_exists'));

        app('files')->put($path, $template);
    }

    /**
     * 规范化缓存数据，兼容旧版本直接缓存模型集合的场景。
     *
     * @param mixed $payload
     * @return array|null
     */
    protected function normalizeCachePayload(mixed $payload): ?array
    {
        // 新缓存只接受数组结构，避免依赖 Laravel 13 的类反序列化白名单。
        if (is_array($payload)) {
            return collect($payload)->every(fn($item) => is_array($item)) ? $payload : null;
        }

        if (!$payload instanceof Collection) {
            return null;
        }

        // 兼容旧缓存中的模型集合，并在读取时自动迁移。
        if ($payload->every(fn($item) => $item instanceof AdminRelationship)) {
            $payload = $payload
                ->map(fn(AdminRelationship $relationship) => $relationship->getAttributes())
                ->values()
                ->all();

            $this->cache()->forever($this->cacheKey, $payload);

            return $payload;
        }

        // 若缓存里已经是数组集合，则直接转为普通数组继续使用。
        if ($payload->every(fn($item) => is_array($item))) {
            return $payload->values()->all();
        }

        return null;
    }
}
