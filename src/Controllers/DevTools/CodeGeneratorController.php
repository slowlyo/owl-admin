<?php

namespace Slowlyo\SlowAdmin\Controllers\DevTools;

use Illuminate\Http\Request;
use Slowlyo\SlowAdmin\Renderers\Page;
use Illuminate\Support\Facades\Artisan;
use Slowlyo\SlowAdmin\Renderers\Form\Form;
use Slowlyo\SlowAdmin\Renderers\Form\Group;
use Slowlyo\SlowAdmin\Renderers\Form\Select;
use Slowlyo\SlowAdmin\Renderers\Form\Checkbox;
use Slowlyo\SlowAdmin\Renderers\Form\InputText;
use Slowlyo\SlowAdmin\Renderers\Form\Checkboxes;
use Slowlyo\SlowAdmin\Renderers\Form\InputTable;
use Slowlyo\SlowAdmin\Controllers\AdminController;
use Slowlyo\SlowAdmin\Libs\CodeGenerator\ModelGenerator;
use Slowlyo\SlowAdmin\Libs\CodeGenerator\ServiceGenerator;
use Slowlyo\SlowAdmin\Libs\CodeGenerator\MigrationGenerator;
use Slowlyo\SlowAdmin\Libs\CodeGenerator\ControllerGenerator;

class CodeGeneratorController extends AdminController
{
    protected string $queryPath = 'dev_tools/code_generator';

    public function index(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $page = Page::make()
            ->title(__('admin.code_generator'))
            ->body($this->form())
            ->remark(
                __('admin.code_generators.remark1') .
                "<a href='https://learnku.com/docs/laravel/9.x/migrations/12248#b419dd' target='_blank'>" .
                __('admin.code_generators.remark2') .
                "</a>, " . __('admin.code_generators.remark3')
            );

        return $this->response()->success($page);
    }

    public function form()
    {
        // 下划线的表名处理成驼峰文件名
        $nameHandler =
            'JOIN(ARRAYMAP(SPLIT(IF(ENDSWITH(table_name, "s"), LEFT(table_name, LEN(table_name) - 1), table_name), "_"), item=>CAPITALIZE(item)))';

        return Form::make()->title(' ')->mode('horizontal')->resetAfterSubmit(true)->api($this->getStorePath())->body([
            Group::make()->body([
                Group::make()->direction('vertical')->body([
                    InputText::make()
                        ->label(__('admin.code_generators.table_name'))
                        ->name('table_name')
                        ->value('')
                        ->required(true),
                    InputText::make()
                        ->label(__('admin.code_generators.model_name'))
                        ->name('model_name')
                        ->value($this->getNamespace('Models', 1) . '${' . $nameHandler . '}'),
                    InputText::make()
                        ->label(__('admin.code_generators.controller_name'))
                        ->name('controller_name')
                        ->value($this->getNamespace('Controllers') . '${' . $nameHandler . '}Controller'),
                    InputText::make()
                        ->label(__('admin.code_generators.service_name'))
                        ->name('service_name')
                        ->value($this->getNamespace('Services', 1) . '${' . $nameHandler . '}Service'),
                ]),
                Group::make()->direction('vertical')->body([
                    InputText::make()
                        ->label(__('admin.code_generators.primary_key'))
                        ->name('primary_key')
                        ->value('id')
                        ->description(__('admin.code_generators.primary_key_description'))
                        ->required(true),
                    Checkboxes::make()->name('needs')->label(__('admin.code_generators.options'))->inline(false)
                        ->joinValues(false)
                        ->extractValue(true)
                        ->options([
                            [
                                'label' => __('admin.code_generators.create_database_migration'),
                                'value' => 'need_database_migration',
                            ],
                            ['label' => __('admin.code_generators.create_table'), 'value' => 'need_create_table'],
                            ['label' => __('admin.code_generators.create_model'), 'value' => 'need_model'],
                            ['label' => __('admin.code_generators.create_controller'), 'value' => 'need_controller'],
                            ['label' => __('admin.code_generators.create_service'), 'value' => 'need_service'],
                        ])->value([
                            'need_database_migration',
                            'need_create_table',
                            'need_model',
                            'need_controller',
                            'need_service',
                        ]),
                ]),
                Group::make()->direction('vertical')->body([
                    InputText::make()
                        ->label(__('admin.code_generators.app_title'))
                        ->name('title')
                        ->value('${' . $nameHandler . '}'),
                    Checkbox::make()->name('need_timestamps')->option('CreatedAt & UpdatedAt')->value(1),
                    Checkbox::make()->name('soft_delete')->option(__('admin.soft_delete'))->value(1),
                ]),
            ]),
            InputTable::make()
                ->name('columns')
                ->addable(true)
                ->needConfirm(false)
                ->draggable(true)
                ->removable(true)
                ->columnsTogglable(false)
                ->value([
                    [
                        'name'       => '',
                        'type'       => 'string',
                        'additional' => 255,
                        'index'      => '',
                    ],
                ])
                ->columns([
                    InputText::make()->name('name')->label(__('admin.code_generators.column_name'))->required(true),
                    Select::make()
                        ->name('type')
                        ->label(__('admin.code_generators.type'))
                        ->options($this->availableFieldTypes())
                        ->searchable(true)
                        ->value('string')
                        ->required(true),
                    InputText::make()
                        ->name('additional')
                        ->label(__('admin.code_generators.extra_params'))
                        ->width(160)
                        ->size('sm'),
                    Checkbox::make()->name('nullable')->label(__('admin.code_generators.nullable'))->width(60),
                    Select::make()
                        ->name('index')
                        ->label(__('admin.code_generators.index'))
                        ->size('sm')
                        ->width(160)
                        ->options(
                            collect(['index', 'unique'])->map(fn($value) => [
                                'label' => $value,
                                'value' => $value,
                            ]))
                        ->clearable(true),
                    InputText::make()->name('default')->label(__('admin.code_generators.default_value')),
                    InputText::make()->name('comment')->label(__('admin.code_generators.comment')),
                ]),
        ]);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $needs   = collect($request->needs);
        $columns = collect($request->columns);

        $paths   = [];
        $message = '';
        try {
            if ($needs->contains('need_model')) {
                $path = ModelGenerator::make()
                    ->primary($request->primary_key)
                    ->timestamps($request->get('need_timestamps', false))
                    ->softDelete($request->get('soft_delete', false))
                    ->generate($request->table_name, $request->model_name);

                $message .= "Model generation succeeded!\n";
                $message .= $path . "\n\n";

                $paths[] = $path;
            }

            if ($needs->contains('need_database_migration')) {
                $path = MigrationGenerator::make()
                    ->primary($request->primary_key)
                    ->timestamps($request->get('need_timestamps', false))
                    ->softDelete($request->get('soft_delete', false))
                    ->generate($request->table_name, $columns);

                $message .= "Migration generation succeeded!\n";
                $message .= $path . "\n\n";

                $paths[] = $path;
            }

            if ($needs->contains('need_controller')) {
                $path = ControllerGenerator::make()
                    ->primary($request->primary_key)
                    ->title($request->title)
                    ->tableName($request->table_name)
                    ->serviceName($request->service_name)
                    ->columns($columns)
                    ->timestamps($request->get('need_timestamps', false))
                    ->generate($request->controller_name);

                $message .= "Controller generation succeeded!\n";
                $message .= $path . "\n\n";

                $paths[] = $path;
            }

            if ($needs->contains('need_service')) {
                $path = ServiceGenerator::make()->generate($request->service_name, $request->model_name);

                $message .= "Service generation succeeded!\n";
                $message .= $path . "\n\n";

                $paths[] = $path;
            }

            if ($needs->contains('need_create_table')) {
                Artisan::call('migrate');
                $message .= Artisan::output();
            }
        } catch (\Exception $e) {
            app('files')->delete($paths);

            return $this->response()->fail($e->getMessage());
        }

        return $this->response()->successMessage($message);
    }

    public function availableFieldTypes(): array
    {
        return collect([
            'bigIncrements',
            'bigInteger',
            'binary',
            'boolean',
            'char',
            'dateTimeTz',
            'dateTime',
            'date',
            'decimal',
            'double',
            'enum',
            'float',
            'foreignId',
            'foreignIdFor',
            'foreignUuid',
            'geometryCollection',
            'geometry',
            'id',
            'increments',
            'integer',
            'ipAddress',
            'json',
            'jsonb',
            'lineString',
            'longText',
            'macAddress',
            'mediumIncrements',
            'mediumInteger',
            'mediumText',
            'morphs',
            'multiLineString',
            'multiPoint',
            'multiPolygon',
            'nullableMorphs',
            'nullableTimestamps',
            'nullableUuidMorphs',
            'point',
            'polygon',
            'rememberToken',
            'set',
            'smallIncrements',
            'smallInteger',
            'softDeletesTz',
            'softDeletes',
            'string',
            'text',
            'timeTz',
            'time',
            'timestampTz',
            'timestamp',
            'timestampsTz',
            'timestamps',
            'tinyIncrements',
            'tinyInteger',
            'tinyText',
            'unsignedBigInteger',
            'unsignedDecimal',
            'unsignedInteger',
            'unsignedMediumInteger',
            'unsignedSmallInteger',
            'unsignedTinyInteger',
            'uuidMorphs',
            'uuid',
            'year',
        ])->map(fn($value) => ['label' => $value, 'value' => $value])->toArray();
    }

    public function getNamespace($name, $app = null): string
    {
        $namespace = collect(explode('\\', config('admin.route.namespace')));

        $namespace->pop();

        if ($app) {
            $namespace->pop();
        }

        return $namespace->push($name)->implode('/') . '/';
    }
}
