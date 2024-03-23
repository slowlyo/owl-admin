<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Illuminate\Support\Facades\Schema;
use Slowlyo\OwlAdmin\Models\AdminRelationship;
use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlAdmin\Services\AdminRelationshipService;

/**
 * @property AdminRelationshipService $service
 */
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
                $this->modelGenerator(),
            ])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('model', '模型')->searchable(),
                amis()->TableColumn('title', '名称')->searchable(),
                amis()->TableColumn('remark', '备注')->searchable(),
                $this->rowActions([
                    $this->previewButton(),
                    $this->rowEditButton(true, 'lg'),
                    $this->rowDeleteButton(),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function modelGenerator()
    {
        return amis()->DrawerAction()->label('生成模型')->level('success')->drawer(
            amis()->Drawer()
                ->title('生成模型')
                ->size('lg')
                ->resizable()
                ->closeOnOutside()
                ->closeOnEsc()
                ->actions([
                    amis()->VanillaAction()->label('生成')->actionType('submit')->level('primary'),
                ])
                ->body([
                    amis()->Form()
                        ->api('/dev_tools/relation/generate_model')
                        ->initApi('/dev_tools/relation/all_models')
                        ->mode('normal')
                        ->body([
                            amis()->TreeControl()
                                ->name('check_tables')
                                ->label()
                                ->multiple()
                                ->heightAuto()
                                ->required()
                                ->source('${all_models}')
                                ->searchable()
                                ->joinValues(false)
                                ->extractValue()
                                ->size('full')
                                ->className('h-full b-none')
                                ->inputClassName('h-full tree-full')
                                ->set('menuTpl', '${label} <span class="text-gray-300 pl-2">${model}</span>'),
                        ]),
                ])
        );
    }

    public function previewButton()
    {
        return amis()->DrawerAction()->label('预览')->level('link')->icon('fa fa-eye')->drawer(
            amis()->Drawer()
                ->position('top')
                ->resizable()
                ->title('预览')
                ->actions([])
                ->showCloseButton(false)
                ->closeOnEsc()
                ->closeOnOutside()
                ->body(
                    amis()->Code()->value('${preview_code | raw}')->language('php')
                )
        );
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

        $columnSelect = function ($name, $label, $modelField = "_blank_model", $tableField = '_blank_table') {
            return amis()
                ->TextControl($name, $label)
                ->source('/dev_tools/relation/column_options?model=${' . $modelField . '}&table=${' . $tableField . '}');
        };

        $args = function ($type, $items) {
            return amis()
                ->ComboControl('args', '参数')
                ->multiLine()
                ->strictMode(false)
                ->items($items)
                ->visibleOn('${type == "' . $type . '"}');
        };

        return $this->baseForm()->data([
            'tables' => collect(json_decode(json_encode(Schema::getAllTables()), true))
                ->map(fn($i) => array_shift($i))
                ->toArray(),
        ])->body([
            amis()->GroupControl()->body([
                amis()->GroupControl()->direction('vertical')->body([
                    $modelSelect('model', '模型'),
                    amis()->TextControl('title', '关联名称')->required()->placeholder('comments'),
                    amis()->TextControl('remark', '备注'),
                    amis()->SelectControl('type', '类型')
                        ->required()
                        ->value(AdminRelationship::TYPE_BELONGS_TO)
                        ->menuTpl('${label} <span class="text-gray-300 pl-2">${method}</span>')
                        ->options(AdminRelationship::typeOptions()),
                ]),
                // 一对一
                $args(AdminRelationship::TYPE_HAS_ONE, [
                    // $related, $foreignKey = null, $localKey = null
                    $modelSelect('related', '关联模型'),
                    $columnSelect('foreignKey', 'foreignKey', 'related'),
                    $columnSelect('localKey', 'localKey', 'model'),
                ]),
                // 一对多
                $args(AdminRelationship::TYPE_HAS_MANY, [
                    // $related, $foreignKey = null, $localKey = null
                    $modelSelect('related', '关联模型'),
                    $columnSelect('foreignKey', 'foreignKey', 'related'),
                    $columnSelect('localKey', 'localKey', 'model'),
                ]),
                // 一对多(反向)/属于
                $args(AdminRelationship::TYPE_BELONGS_TO, [
                    // $related, $foreignKey = null, $ownerKey = null, $relation = null
                    $modelSelect('related', '关联模型'),
                    $columnSelect('foreignKey', 'foreignKey', 'model'),
                    $columnSelect('ownerKey', 'ownerKey', 'related'),
                    amis()->TextControl('relation', 'relation'),
                ]),
                // 多对多
                $args(AdminRelationship::TYPE_BELONGS_TO_MANY, [
                    // $related, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $relation = null
                    $modelSelect('related', '关联模型'),
                    amis()->SelectControl('table', 'table')->source('${tables}')->searchable(),
                    $columnSelect('foreignPivotKey', 'foreignPivotKey', '_blank_model', 'table'),
                    $columnSelect('relatedPivotKey', 'relatedPivotKey', '_blank_model', 'table'),
                    $columnSelect('parentKey', 'parentKey', 'model'),
                    $columnSelect('relatedKey', 'relatedKey', 'related'),
                    amis()->TextControl('relation', 'relation'),
                ]),
                // 远程一对一
                $args(AdminRelationship::TYPE_HAS_ONE_THROUGH, [
                    // $related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null
                    $modelSelect('related', '关联模型'),
                    $modelSelect('through', '中间模型'),
                    $columnSelect('firstKey', 'firstKey', 'through'),
                    $columnSelect('secondKey', 'secondKey', 'related'),
                    $columnSelect('localKey', 'localKey', 'model'),
                    $columnSelect('secondLocalKey', 'secondLocalKey', 'through'),
                ]),
                // 远程一对多
                $args(AdminRelationship::TYPE_HAS_MANY_THROUGH, [
                    // $related, $through, $firstKey = null, $secondKey = null, $localKey = null, $secondLocalKey = null
                    $modelSelect('related', '关联模型'),
                    $modelSelect('through', '中间模型'),
                    $columnSelect('firstKey', 'firstKey', 'through'),
                    $columnSelect('secondKey', 'secondKey', 'related'),
                    $columnSelect('localKey', 'localKey', 'model'),
                    $columnSelect('secondLocalKey', 'secondLocalKey', 'through'),
                ]),
                // 一对一(多态)
                $args(AdminRelationship::TYPE_MORPH_ONE, [
                    // $related, $name, $type = null, $id = null, $localKey = null
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('name', 'name')->required(),
                    amis()->TextControl('type', 'type'),
                    amis()->TextControl('id', 'id'),
                    $columnSelect('localKey', 'localKey', 'model'),
                ]),
                // 一对多(多态)
                $args(AdminRelationship::TYPE_MORPH_MANY, [
                    // $related, $name, $type = null, $id = null, $localKey = null
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('name', 'name')->required(),
                    amis()->TextControl('type', 'type'),
                    amis()->TextControl('id', 'id'),
                    $columnSelect('localKey', 'localKey', 'model'),
                ]),
                // 多对多(多态)
                $args(AdminRelationship::TYPE_MORPH_TO_MANY, [
                    // $related, $name, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $inverse = false
                    $modelSelect('related', '关联模型'),
                    amis()->TextControl('name', 'name')->required(),
                    amis()->SelectControl('table', 'table')->source('${tables}')->searchable(),
                    $columnSelect('foreignPivotKey', 'foreignPivotKey', '_blank_model', 'table'),
                    $columnSelect('relatedPivotKey', 'relatedPivotKey', '_blank_model', 'table'),
                    $columnSelect('parentKey', 'parentKey', 'model'),
                    $columnSelect('relatedKey', 'relatedKey', 'related'),
                    amis()->TextControl('inverse', 'inverse'),
                ]),
            ]),
        ]);
    }


    public function detail($id)
    {
        return $this->baseDetail()->body([]);
    }

    /**
     * 获取所有 model
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function modelOptions()
    {
        $models = $this->service->allModels()['models'];

        return $this->response()->success($models);
    }

    /**
     * 字段选项
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function columnOptions()
    {
        $model = request('model');
        $table = request('table');

        if (blank($model) && blank($table)) {
            return $this->response()->success([]);
        }

        $table = $table ?: app($model)->getTable();

        $columns = Schema::getColumnListing($table);

        return $this->response()->success($columns);
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function allModels()
    {
        $all    = $this->service->allModels();
        $tables = $all['tables'];
        $models = collect($all['models'])->keyBy('table');

        $all_models = collect($tables)->map(function ($item) use ($models) {
            $model = data_get($models, $item . '.value');

            return [
                'value'    => $item,
                'label'    => $item,
                'model'    => $model,
                'disabled' => (bool)$model,
            ];
        })->sortBy('disabled')->values();

        return $this->response()->success(compact('all_models'));
    }

    /**
     * 生成模型
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function generateModel()
    {
        $tables     = request('check_tables');
        $existsList = collect($this->service->allModels()['models'])->pluck('table')->toArray();
        $exists     = array_intersect($tables, $existsList);

        admin_abort_if(filled($exists), '模型已存在：' . implode(',', $exists));

        try {
            foreach ($tables as $table) {
                $this->service->generateModel($table);
            }
        } catch (\Throwable $e) {
            return $this->response()->fail($e->getMessage());
        }

        return $this->response()->successMessage(__('admin.action_success'));
    }
}
