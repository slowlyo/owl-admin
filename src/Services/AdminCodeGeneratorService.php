<?php

namespace Slowlyo\OwlAdmin\Services;

use Illuminate\Support\Arr;
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

    public function store($data)
    {
        amis_abort_if(
            $this->query()->where('table_name', $data['table_name'])->exists(),
            __('admin.code_generators.exists_table')
        );

        return parent::store($this->filterData($data));
    }

    public function update($primaryKey, $data)
    {
        $exists = $this->query()
            ->where('table_name', $data['table_name'])
            ->where($this->primaryKey(), '<>', $primaryKey)
            ->exists();

        amis_abort_if($exists, __('admin.code_generators.exists_table'));

        return parent::update($primaryKey, $this->filterData($data));
    }

    public function filterData($data)
    {
        admin_abort_if(!data_get($data, 'columns'), __('admin.required', ['attribute' => __('admin.code_generators.column_info')]));

        $data['columns'] = collect($data['columns'])
            ->map(fn($item) => Arr::except($item, ['component_options']))
            ->toArray();

        return Arr::except($data, ['table_info', 'table_primary_keys']);
    }
}
