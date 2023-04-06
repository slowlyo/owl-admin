<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\Renderers\Page;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Renderers\Card;
use Slowlyo\OwlAdmin\Renderers\Flex;
use Slowlyo\OwlAdmin\Renderers\Alert;
use Illuminate\Support\Facades\Artisan;
use Slowlyo\OwlAdmin\Renderers\TextControl;
use Slowlyo\OwlAdmin\Renderers\GroupControl;
use Slowlyo\OwlAdmin\Renderers\TableControl;
use Slowlyo\OwlAdmin\Renderers\SelectControl;
use Slowlyo\OwlAdmin\Renderers\VanillaAction;
use Slowlyo\OwlAdmin\Renderers\CheckboxControl;
use Slowlyo\OwlAdmin\Renderers\FieldSetControl;
use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlAdmin\Renderers\CheckboxesControl;
use Slowlyo\OwlAdmin\Libs\CodeGenerator\Generator;
use Slowlyo\OwlAdmin\Libs\CodeGenerator\ModelGenerator;
use Slowlyo\OwlAdmin\Libs\CodeGenerator\ServiceGenerator;
use Slowlyo\OwlAdmin\Libs\CodeGenerator\MigrationGenerator;
use Slowlyo\OwlAdmin\Libs\CodeGenerator\ControllerGenerator;

class CodeGeneratorController extends AdminController
{
    public function index(): \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
    {
        $page = Page::make()
            ->css([
                '.amis-scope .cxd-Table-content' => ['padding-bottom' => '15px'],
            ])
            ->body($this->form());

        return $this->response()->success($page);
    }

    public function form()
    {
        $databaseColumns = Generator::make()->getDatabaseColumns();
        // 下划线的表名处理成驼峰文件名
        $nameHandler =
            'JOIN(ARRAYMAP(SPLIT(IF(ENDSWITH(table_name, "s"), LEFT(table_name, LEN(table_name) - 1), table_name), "_"), item=>CAPITALIZE(item)))';

        return Form::make()
            ->id('code_generator_form')
            ->wrapWithPanel(false)
            ->title(' ')
            ->mode('horizontal')
            ->resetAfterSubmit(true)
            ->api($this->getStorePath())
            ->data(['table_info' => $databaseColumns])
            ->feedback(['title' => '', 'body' => amisMake()->Tpl()->tpl('${result | raw}')])
            ->body([
                Card::make()->body(
                    GroupControl::make()->body([
                        GroupControl::make()->direction('vertical')->body([
                            GroupControl::make()->body([
                                TextControl::make()
                                    ->label(__('admin.code_generators.app_title'))
                                    ->name('title')
                                    ->value('${' . $nameHandler . '}'),
                                Flex::make()->justify('end')->items([
                                    VanillaAction::make()
                                        ->type('submit')
                                        ->label(__('admin.code_generators.generate_code'))
                                        ->level('primary')
                                        ->icon('fa-solid fa-terminal'),
                                ]),
                            ]),
                            GroupControl::make()->body([
                                TextControl::make()
                                    ->label(__('admin.code_generators.table_name'))
                                    ->name('table_name')
                                    ->value('')
                                    ->required(true),
                                SelectControl::make()
                                    ->label(__('admin.code_generators.exists_table'))
                                    ->name('exists_table')
                                    ->searchable(true)
                                    ->clearable(true)
                                    ->selectMode('group')
                                    ->options(
                                        $databaseColumns->map(function ($item, $index) {
                                            return [
                                                'label'    => $index,
                                                'children' => $item->keys()->map(function ($item) use ($index) {
                                                    return ['value' => $item . '-' . $index, 'label' => $item];
                                                }),
                                            ];
                                        })->values()
                                    )
                                    ->onEvent([
                                        'change' => [
                                            'actions' => [
                                                // 更新 table_name 的值
                                                [
                                                    'actionType'  => 'setValue',
                                                    'componentId' => 'code_generator_form',
                                                    'args'        => [
                                                        'value' => [
                                                            'table_name' => '${SPLIT(event.data.value, "-")[0]}',
                                                        ],
                                                    ],
                                                ],
                                                [
                                                    'actionType'  => 'setValue',
                                                    'componentId' => 'code_generator_form',
                                                    'args'        => [
                                                        'value' => [
                                                            'columns' => '${table_info[SPLIT(event.data.value, "-")[1]][SPLIT(event.data.value, "-")[0]]}',
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ]),
                            ]),
                            CheckboxesControl::make()
                                ->name('needs')
                                ->label(__('admin.code_generators.options'))
                                ->joinValues(false)
                                ->extractValue(true)
                                ->checkAll(true)
                                ->defaultCheckAll(true)
                                ->options(Generator::make()->needCreateOptions()),
                            FieldSetControl::make()
                                ->title(__('admin.code_generators.expand_more_settings'))
                                ->collapseTitle(__('admin.code_generators.collapse_settings'))
                                ->collapsable(true)
                                ->collapsed(true)
                                ->titlePosition('bottom')->body([
                                    TextControl::make()
                                        ->label(__('admin.code_generators.primary_key'))
                                        ->name('primary_key')
                                        ->value('id')
                                        ->description(__('admin.code_generators.primary_key_description'))
                                        ->required(true),
                                    TextControl::make()
                                        ->label(__('admin.code_generators.model_name'))
                                        ->name('model_name')
                                        ->value($this->getNamespace('Models', 1) . '${' . $nameHandler . '}'),
                                    TextControl::make()
                                        ->label(__('admin.code_generators.controller_name'))
                                        ->name('controller_name')
                                        ->value($this->getNamespace('Controllers') . '${' . $nameHandler . '}Controller'),
                                    TextControl::make()
                                        ->label(__('admin.code_generators.service_name'))
                                        ->name('service_name')
                                        ->value($this->getNamespace('Services',
                                                1) . '${' . $nameHandler . '}Service'),
                                    CheckboxControl::make()
                                        ->name('need_timestamps')
                                        ->option('CreatedAt & UpdatedAt')
                                        ->value(1),
                                    CheckboxControl::make()
                                        ->name('soft_delete')
                                        ->option(__('admin.soft_delete'))
                                        ->value(1),
                                ]),
                        ]),
                    ]),
                ),
                $this->columnTable(),
            ]);
    }

    public function columnTable()
    {
        return Card::make()->body([
            Alert::make()
                ->body("如果字段名存在 no、status 会导致 form 回显失败! <a href='https://slowlyo.gitee.io/owl-admin-doc/#/docs/issue?id=%f0%9f%90%9b-%e7%bc%96%e8%be%91-%e8%af%a6%e6%83%85%e9%a1%b5%e9%9d%a2%e6%95%b0%e6%8d%ae%e5%9b%9e%e6%98%be%e5%a4%b1%e8%b4%a5' target='_blank'>查看详情</a> ")
                ->level('warning')
                ->showCloseButton(true)
                ->showIcon(true),
            TableControl::make()
                ->className('pb-7')
                ->name('columns')
                ->label(false)
                ->addable(true)
                ->needConfirm(false)
                ->draggable(true)
                ->removable(true)
                ->columnsTogglable(false)
                ->value([['name' => '', 'type' => '', 'additional' => '', 'index' => '']])
                ->columns([
                    TextControl::make()
                        ->name('name')
                        ->label(__('admin.code_generators.column_name'))
                        ->required(true),
                    SelectControl::make()
                        ->name('type')
                        ->label(__('admin.code_generators.type'))
                        ->options(Generator::make()->availableFieldTypes())
                        ->searchable(true)
                        ->value('string')
                        ->required(true),
                    TextControl::make()
                        ->name('additional')
                        ->label(
                            amisMake()->TooltipWrapper()->body([
                                __('admin.code_generators.extra_params'),
                                amisMake()->Icon()->icon('fa fa-circle-question')->className('pl-2'),
                            ])->content(
                                __('admin.code_generators.remark1') .
                                "<a href='https://learnku.com/docs/laravel/9.x/migrations/12248#b419dd' target='_blank'>" .
                                __('admin.code_generators.remark2') .
                                "</a>, " . __('admin.code_generators.remark3')
                            )
                        )
                        ->width(160)
                        ->size('sm'),
                    CheckboxControl::make()
                        ->name('nullable')
                        ->label(__('admin.code_generators.nullable'))
                        ->width(60),
                    SelectControl::make()
                        ->name('index')
                        ->label(__('admin.code_generators.index'))
                        ->size('xs')
                        ->width(90)
                        ->options(
                            collect(['index', 'unique'])->map(fn($value) => [
                                'label' => $value,
                                'value' => $value,
                            ]))
                        ->clearable(true),
                    TextControl::make()->name('comment')->label(__('admin.code_generators.comment')),
                    TextControl::make()
                        ->name('default')
                        ->label(__('admin.code_generators.default_value')),
                    // amisMake()->SubFormControl()->name('more')->label('更多设置')->btnLabel('更多')->form(
                    //     amisMake()->Form()->title('更多设置')->set('size', 'lg')->body([])
                    // ),
                ]),
        ]);
    }

    public function store(Request $request)
    {
        $needs          = collect($request->needs);
        $columns        = collect($request->columns);
        $successMessage = function ($type, $path) {
            return "<b class='text-success'>{$type} generated successfully!</b><br>{$path}<br><br>";
        };

        $paths   = [];
        $message = '';
        try {
            // Model
            if ($needs->contains('need_model')) {
                $path = ModelGenerator::make()
                    ->primary($request->primary_key)
                    ->timestamps($request->get('need_timestamps', false))
                    ->softDelete($request->get('soft_delete', false))
                    ->generate($request->table_name, $request->model_name);

                $message .= $successMessage('Model', $path);

                $paths[] = $path;
            }

            // Migration
            if ($needs->contains('need_database_migration')) {
                $path = MigrationGenerator::make()
                    ->primary($request->primary_key)
                    ->timestamps($request->get('need_timestamps', false))
                    ->softDelete($request->get('soft_delete', false))
                    ->generate($request->table_name, $columns);

                $message .= $successMessage('Migration', $path);

                $paths[] = $path;
            }

            // Controller
            if ($needs->contains('need_controller')) {
                $path = ControllerGenerator::make()
                    ->primary($request->primary_key)
                    ->title($request->title)
                    ->tableName($request->table_name)
                    ->serviceName($request->service_name)
                    ->columns($columns)
                    ->timestamps($request->get('need_timestamps', false))
                    ->generate($request->controller_name);

                $message .= $successMessage('Controller', $path);

                $paths[] = $path;
            }

            // Service
            if ($needs->contains('need_service')) {
                $path = ServiceGenerator::make()->generate($request->service_name, $request->model_name);

                $message .= $successMessage('Service', $path);

                $paths[] = $path;
            }

            // 创建数据库表
            if ($needs->contains('need_create_table')) {
                Artisan::call('migrate');
                $message .= Artisan::output();
            }
        } catch (\Exception $e) {
            app('files')->delete($paths);

            return $this->response()->fail($e->getMessage());
        }

        return $this->response()->doNotDisplayToast()->success(['result' => $message]);
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
