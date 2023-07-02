<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Admin;
use Illuminate\Database\Eloquent\Builder;
use Slowlyo\OwlAdmin\Models\AdminCodeGenerator;

/**
 * @method AdminCodeGenerator getModel()
 * @method AdminCodeGenerator|Builder query()
 */
class AdminCodeGeneratorService extends AdminService
{
    protected string $modelName = AdminCodeGenerator::class;

    public function listQuery()
    {
        $keyword = request('keyword');

        return parent::listQuery()->when($keyword, function ($query) use ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('table_name', 'like', "%{$keyword}%")->orWhere('title', 'like', "%{$keyword}%");
            });
        });
    }

    public function store($data): bool
    {
        if ($this->query()->where('table_name', $data['table_name'])->exists()) {
            return $this->setError(__('admin.code_generators.exists_table'));
        }

        return parent::store($this->filterData($data));
    }

    public function update($primaryKey, $data): bool
    {
        $exists = $this->query()
            ->where('table_name', $data['table_name'])
            ->where($this->primaryKey(), '<>', $primaryKey)
            ->exists();

        if ($exists) {
            return $this->setError(__('admin.code_generators.exists_table'));
        }

        return parent::update($primaryKey, $this->filterData($data));
    }

    public function filterData($data)
    {
        $data['columns'] = collect($data['columns'])
            ->map(fn($item) => Arr::except($item, ['component_options']))
            ->toArray();

        return Arr::except($data, ['table_info', 'table_primary_keys']);
    }
}
