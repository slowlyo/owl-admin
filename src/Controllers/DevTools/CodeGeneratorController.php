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
            ->title('代码生成器')
            ->body($this->form())
            ->remark("额外参数请参考<a href='https://learnku.com/docs/laravel/9.x/migrations/12248#b419dd' target='_blank'>数据库迁移</a>, 多个参数使用英文逗号分割");

        return $this->response()->success($page);
    }

    public function form()
    {
        // 下划线的表名处理成驼峰文件名
        $nameHandler =
            'JOIN(ARRAYMAP(SPLIT(IF(ENDSWITH(table_name, "s"), LEFT(table_name, LEN(table_name) - 1), table_name), "_"), item=>CAPITALIZE(item)))';

        return Form::make()->title(' ')->mode('horizontal')->resetAfterSubmit()->api($this->getStorePath())->body([
            Group::make()->body([
                Group::make()->direction('vertical')->body([
                    InputText::make()
                        ->label('表名')
                        ->name('table_name')
                        ->value('')
                        ->required(),
                    InputText::make()
                        ->label('模型')
                        ->name('model_name')
                        ->value($this->getNamespace('Models', 1) . '${' . $nameHandler . '}'),
                    InputText::make()
                        ->label('控制器')
                        ->name('controller_name')
                        ->value($this->getNamespace('Controllers') . '${' . $nameHandler . '}Controller'),
                    InputText::make()
                        ->label('Service')
                        ->name('service_name')
                        ->value($this->getNamespace('Services', 1) . '${' . $nameHandler . '}Service'),
                ]),
                Group::make()->direction('vertical')->body([
                    InputText::make()
                        ->label('主键名称')
                        ->name('primary_key')
                        ->value('id')
                        ->description('使用 increments 方法')
                        ->required(),
                    Checkboxes::make()->name('needs')->label('可选项')->inline(false)
                        ->joinValues(false)
                        ->extractValue(true)
                        ->options([
                            ['label' => '创建数据迁移文件', 'value' => 'need_database_migration'],
                            ['label' => '创建数据表', 'value' => 'need_create_table'],
                            ['label' => '创建模型', 'value' => 'need_model'],
                            ['label' => '创建控制器', 'value' => 'need_controller'],
                            ['label' => '创建Service', 'value' => 'need_service'],
                        ])->value([
                            'need_database_migration',
                            'need_create_table',
                            'need_model',
                            'need_controller',
                            'need_service',
                        ]),
                ]),
                Group::make()->direction('vertical')->body([
                    InputText::make()->label('功能名称')->name('title')->value('${' . $nameHandler . '}'),
                    Checkbox::make()->name('need_timestamps')->option('CreatedAt & UpdatedAt')->value(1),
                    Checkbox::make()->name('soft_delete')->option('软删除')->value(1),
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
                    InputText::make()->name('name')->label('字段名')->required(),
                    Select::make()
                        ->name('type')
                        ->label('类型')
                        ->options($this->availableFieldTypes())
                        ->searchable(true)
                        ->value('string')
                        ->required(true),
                    InputText::make()
                        ->name('additional')
                        ->label('额外参数')
                        ->width(160)
                        ->size('sm'),
                    Checkbox::make()->name('nullable')->label('允许空值')->width(60),
                    Select::make()->name('index')->label('索引')->size('sm')->width(160)->options(
                        collect(['index', 'unique'])->map(fn($value) => [
                            'label' => $value,
                            'value' => $value,
                        ]))->clearable(true),
                    InputText::make()->name('default')->label('默认值'),
                    InputText::make()->name('comment')->label('注释'),
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
