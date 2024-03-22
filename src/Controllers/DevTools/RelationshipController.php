<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Slowlyo\OwlAdmin\Support\Cores\Module;
use Slowlyo\OwlAdmin\Models\AdminRelationship;
use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlAdmin\Services\AdminRelationshipService;
use Spatie\LaravelIgnition\Support\Composer\ComposerClassMap;

class RelationshipController extends AdminController
{
    protected string $serviceName = AdminRelationshipService::class;

    public function list()
    {
        $crud = $this->baseCRUD()
            ->filterTogglable(false)
            ->headerToolbar([
                $this->createButton(true, 'lg'),
                ...$this->baseHeaderToolBar(),
            ])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('title', '名称')->searchable(),
                amis()->TableColumn('sign', '标识')->searchable(),
                $this->rowActions([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton(),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form()
    {
        $modelSelect = function ($name, $label) {
            return amis()
                ->SelectControl($name, $label)
                ->required()
                ->menuTpl('${label} <span class="text-gray-300 pl-2">${table}</span>')
                ->source('/dev_tools/relation/model_options')
                ->searchable();
        };

        return $this->baseForm()->body([
            amis()->GroupControl()->body([
                amis()->GroupControl()->direction('vertical')->body([
                    $modelSelect('model', '模型'),
                    amis()->TextControl('title', '关联名称')->required()->placeholder('comments'),
                    amis()->TextControl('remark', '备注'),
                    amis()->SelectControl('type', '类型')
                        ->required()
                        ->value(AdminRelationship::TYPE_BELONGS_TO)
                        ->options(map2options(AdminRelationship::TYPE_LABEL_MAP)),
                ]),
                // 一对一
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $foreignKey = null, $localKey = null
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('foreignKey', 'foreignKey'),
                    amis()->TextControl('localKey', 'localKey'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_HAS_ONE . '"}'),
                // 一对多
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $foreignKey = null, $localKey = null
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('foreignKey', 'foreignKey'),
                    amis()->TextControl('localKey', 'localKey'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_HAS_MANY . '"}'),
                // 一对多(反向)/属于
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $foreignKey = null, $ownerKey = null, $relation = null
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('foreignKey', 'foreignKey'),
                    amis()->TextControl('ownerKey', 'ownerKey'),
                    amis()->TextControl('relation', 'relation'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_BELONGS_TO . '"}'),
                // 多对多
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('table', 'table'),
                    amis()->TextControl('foreignPivotKey', 'foreignPivotKey'),
                    amis()->TextControl('relatedPivotKey', 'relatedPivotKey'),
                    amis()->TextControl('parentKey', 'parentKey'),
                    amis()->TextControl('relatedKey', 'relatedKey'),
                    amis()->TextControl('relation', 'relation'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_BELONGS_TO_MANY . '"}'),
                // 远程一对一
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null
                    $modelSelect('related', '关联模型'),
                    $modelSelect('through', '中间模型'),
                    amis()->TextControl('firstKey', 'firstKey'),
                    amis()->TextControl('secondKey', 'secondKey'),
                    amis()->TextControl('localKey', 'localKey'),
                    amis()->TextControl('secondLocalKey', 'secondLocalKey'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_HAS_ONE_THROUGH . '"}'),
                // 远程一对多
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null
                    $modelSelect('related', '关联模型'),
                    $modelSelect('through', '中间模型'),
                    amis()->TextControl('firstKey', 'firstKey'),
                    amis()->TextControl('secondKey', 'secondKey'),
                    amis()->TextControl('localKey', 'localKey'),
                    amis()->TextControl('secondLocalKey', 'secondLocalKey'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_HAS_MANY_THROUGH . '"}'),
                // 一对一(多态)
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $name, $type = null, $id = null, $localKey = null
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('name', 'name')->required(),
                    amis()->TextControl('type', 'type'),
                    amis()->TextControl('id', 'id'),
                    amis()->TextControl('localKey', 'localKey'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_MORPH_ONE . '"}'),
                // 一对多(多态)
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $name, $type = null, $id = null, $localKey = null
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('name', 'name')->required(),
                    amis()->TextControl('type', 'type'),
                    amis()->TextControl('id', 'id'),
                    amis()->TextControl('localKey', 'localKey'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_MORPH_MANY . '"}'),
                // 多对多(多态)
                amis()->ComboControl('args', '参数')->multiLine()->items([
                    // $related, $name, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $inverse = false
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('name', 'name')->required(),
                    amis()->TextControl('table', 'table'),
                    amis()->TextControl('foreignPivotKey', 'foreignPivotKey'),
                    amis()->TextControl('relatedPivotKey', 'relatedPivotKey'),
                    amis()->TextControl('parentKey', 'parentKey'),
                    amis()->TextControl('relatedKey', 'relatedKey'),
                    amis()->TextControl('inverse', 'inverse'),
                ])->visibleOn('${type == "' . AdminRelationship::TYPE_MORPH_TO_MANY . '"}'),
            ]),
        ]);
    }


    public function detail($id)
    {
        return $this->baseDetail()->body([]);
    }

    /**
     * 获取所有已经加载的 model
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function modelOptions()
    {
        $composer = require base_path('/vendor/autoload.php');
        $classMap = $composer->getClassMap();

        $tables = collect(json_decode(json_encode(Schema::getAllTables()), true))
            ->map(fn($i) => array_shift($i))
            ->toArray();

        $models = collect($classMap)
            ->keys()
            ->filter(fn($item) => str_contains($item, 'Models\\'))
            ->filter(fn($item) => (new \ReflectionClass($item))->isSubclassOf(Model::class))
            ->filter(fn($item) => in_array(app($item)->getTable(), $tables))
            ->values()
            ->map(fn($item) => [
                'label' => Str::of($item)->explode('\\')->pop(),
                'table' => app($item)->getTable(),
                'value' => $item,
            ]);

        return $this->response()->success($models);
    }
}
