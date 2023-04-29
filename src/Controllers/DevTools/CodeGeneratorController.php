<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\Renderers\Page;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Slowlyo\OwlAdmin\Controllers\AdminController;
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
            ->css($this->css())
            ->body($this->form());

        return $this->response()->success($page);
    }


    public function form()
    {
        $databaseColumns = Generator::make()->getDatabaseColumns();
        // 下划线的表名处理成驼峰文件名
        $nameHandler =
            'JOIN(ARRAYMAP(SPLIT(IF(ENDSWITH(table_name, "s"), LEFT(table_name, LEN(table_name) - 1), table_name), "_"), item=>CAPITALIZE(item)))';

        return amisMake()->Form()
            ->id('code_generator_form')
            ->wrapWithPanel(false)
            ->labelWidth(150)
            ->title(' ')
            ->mode('horizontal')
            ->resetAfterSubmit()
            ->api($this->getStorePath())
            ->data([
                'table_info'         => $databaseColumns,
                'table_primary_keys' => Generator::make()->getDatabasePrimaryKeys(),
            ])
            ->feedback(['title' => '', 'body' => amisMake()->Tpl()->tpl('${result | raw}')])
            ->body([
                amisMake()->Card()->body(
                    amisMake()->GroupControl()->body([
                        amisMake()->GroupControl()->direction('vertical')->body([
                            amisMake()->GroupControl()->body([
                                amisMake()
                                    ->TextControl('title', __('admin.code_generators.app_title'))
                                    ->value('${' . $nameHandler . '}'),
                                amisMake()->Flex()->justify('end')->items([
                                    amisMake()->VanillaAction()
                                        ->type('submit')
                                        ->label(__('admin.code_generators.generate_code'))
                                        ->level('primary')
                                        ->icon('fa-solid fa-terminal'),
                                ]),
                            ]),
                            amisMake()->GroupControl()->body([
                                amisMake()->TextControl('table_name', __('admin.code_generators.table_name'))
                                    ->value()
                                    ->required(),
                                amisMake()->SelectControl('exists_table', __('admin.code_generators.exists_table'))
                                    ->searchable()
                                    ->clearable()
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
                                                            'table_name'  => '${SPLIT(event.data.value, "-")[0]}',
                                                            'primary_key' => '${table_primary_keys[SPLIT(event.data.value, "-")[1]][SPLIT(event.data.value, "-")[0]]}',
                                                            'columns'     => '${table_info[SPLIT(event.data.value, "-")[1]][SPLIT(event.data.value, "-")[0]]}',
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ]),
                            ]),
                            amisMake()->CheckboxesControl('needs', __('admin.code_generators.options'))
                                ->joinValues(false)
                                ->extractValue()
                                ->checkAll()
                                ->defaultCheckAll()
                                ->options(Generator::make()->needCreateOptions()),
                            // amisMake()
                            //     ->SwitchControl('overwrite', __('admin.code_generators.overwrite'))
                            //     ->onText(__('admin.code_generators.overwrite_description')),
                            amisMake()->FieldSetControl()
                                ->title(__('admin.code_generators.expand_more_settings'))
                                ->collapseTitle(__('admin.code_generators.collapse_settings'))
                                ->collapsable()
                                ->collapsed()
                                ->titlePosition('bottom')->body([
                                    amisMake()->TextControl('primary_key', __('admin.code_generators.primary_key'))
                                        ->value('id')
                                        ->description(__('admin.code_generators.primary_key_description'))
                                        ->required(),
                                    amisMake()->TextControl('model_name', __('admin.code_generators.model_name'))
                                        ->value($this->getNamespace('Models', 1) . '${' . $nameHandler . '}'),
                                    amisMake()
                                        ->TextControl('controller_name', __('admin.code_generators.controller_name'))
                                        ->value($this->getNamespace('Controllers') . '${' . $nameHandler . '}Controller'),
                                    amisMake()->TextControl('service_name', __('admin.code_generators.service_name'))
                                        ->value($this->getNamespace('Services', 1) . '${' . $nameHandler . '}Service'),
                                    amisMake()->SwitchControl('need_timestamps', 'CreatedAt & UpdatedAt')->value(1),
                                    amisMake()->SwitchControl('soft_delete', __('admin.soft_delete'))->value(1),
                                ]),
                        ]),
                    ]),
                ),
                $this->columnTable(),
            ]);
    }

    public function columnTable()
    {
        return amisMake()->Card()->body([
            amisMake()->Alert()
                ->body("如果字段名存在 no、status 会导致 form 回显失败! <a href='https://slowlyo.gitee.io/owl-admin-doc/#/docs/issue?id=%f0%9f%90%9b-%e7%bc%96%e8%be%91-%e8%af%a6%e6%83%85%e9%a1%b5%e9%9d%a2%e6%95%b0%e6%8d%ae%e5%9b%9e%e6%98%be%e5%a4%b1%e8%b4%a5' target='_blank'>查看详情</a> ")
                ->level('warning')
                ->showCloseButton()
                ->showIcon(),
            amisMake()
                ->SubFormControl('columns', false)
                ->multiple()
                ->btnLabel('${"<div class=\'column-name\'>"+name + "</div><div class=\'text-success\'>" + type+"</div><div class=\'item-comment\'>"+comment+"</div>"}')
                ->minLength(1)
                ->draggable()
                ->addable()
                ->removable()
                ->itemClassName('custom-subform-item')
                ->addButtonText('添加字段')
                ->form(
                    amisMake()->FormControl()->set('title', '添加字段')->body([
                        amisMake()->TextControl('name', __('admin.code_generators.column_name'))->required(),
                        amisMake()->SelectControl('type', __('admin.code_generators.type'))
                            ->options(Generator::make()->availableFieldTypes())
                            ->searchable()
                            ->value('string')
                            ->required(),
                        amisMake()->TextControl('comment', __('admin.code_generators.comment')),
                        amisMake()->TextControl('default', __('admin.code_generators.default_value')),
                        amisMake()->TextControl('additional', __('admin.code_generators.extra_params'))
                            ->labelRemark(
                                __('admin.code_generators.remark1') .
                                "<a href='https://learnku.com/docs/laravel/9.x/migrations/12248#b419dd' target='_blank'>" .
                                __('admin.code_generators.remark2') .
                                "</a>, " . __('admin.code_generators.remark3')
                            ),
                        amisMake()->SelectControl('index', __('admin.code_generators.index'))
                            ->options(
                                collect(['index', 'unique'])->map(fn($value) => [
                                    'label' => $value,
                                    'value' => $value,
                                ]))
                            ->clearable(),
                        amisMake()->SwitchControl('nullable', __('admin.code_generators.nullable'))->width(60),
                    ])
                ),
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
                    ->overwrite($request->get('overwrite', false))
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
                    ->overwrite($request->get('overwrite', false))
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
                $path = ServiceGenerator::make()
                    ->overwrite($request->get('overwrite', false))
                    ->generate($request->service_name, $request->model_name);

                $message .= $successMessage('Service', $path);

                $paths[] = $path;
            }

            // 创建数据库表
            if ($needs->contains('need_create_table')) {
                if ($request->get('overwrite', false)) {
                    Schema::dropIfExists($request->table_name);
                }

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

    private function css()
    {
        return [
            '.cxd-Table-content'                             => ['padding-bottom' => '15px'],
            '.item-comment'                                  => [
                'width'         => '220px',
                'height'        => '18px',
                'overflow'      => 'hidden',
                'text-overflow' => 'ellipsis',
                'white-space'   => 'nowrap',
                'color'         => '#a9aeb8',
                'font-size'     => '12px',
            ],
            '.column-name'                                   => [
                'max-width'     => '160px',
                'overflow'      => 'hidden',
                'text-overflow' => 'ellipsis',
                'white-space'   => 'nowrap',
                'font-weight'   => 'bold',
            ],
            '.custom-subform-item'                           => [
                'border'        => '1px solid #eee',
                'border-radius' => '4px',
                'margin'        => '5px',
                'width'         => '16%',
                'padding'       => '10px',
                'min-width'     => '220px',
                'position'      => 'relative',
            ],
            '.custom-subform-item .cxd-SubForm-valueDragBar' => [
                'position' => 'absolute',
                'top'      => '5px',
                'left'     => '10px',
            ],
            '.custom-subform-item .cxd-SubForm-valueLabel'   => [
                'margin-left' => '20px',
            ],
            '.custom-subform-item .cxd-SubForm-valueEdit'    => [
                'position' => 'absolute',
                'top'      => '5px',
                'right'    => '30px',
            ],
            '.custom-subform-item .cxd-SubForm-valueDel'     => [
                'position' => 'absolute',
                'top'      => '5px',
                'right'    => '10px',
            ],
        ];
    }
}
