<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\Renderers\Page;
use Illuminate\Support\Facades\Artisan;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\ModelGenerator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\RouteGenerator;
use Slowlyo\OwlAdmin\Services\AdminCodeGeneratorService;
use Slowlyo\OwlAdmin\Support\CodeGenerator\ServiceGenerator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\MigrationGenerator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\ControllerGenerator;

/**
 * @property AdminCodeGeneratorService $service
 */
class CodeGeneratorController extends AdminController
{
    protected string $serviceName = AdminCodeGeneratorService::class;

    public function index()
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->list());
        }

        return $this->response()->success(
            Page::make()->css($this->css())->body($this->list())
        );
    }

    public function list()
    {
        $formDrawer = function ($isEdit = false) {
            $body = $this->form();

            if ($isEdit) {
                $body = $body->initApi($this->getEditGetDataPath())->api($this->getUpdatePath());
            } else {
                $body = $body->api($this->getStorePath());
            }

            return amis()
                ->Dialog()
                ->size('full')
                ->title($isEdit ? __('admin.edit') : __('admin.create'))
                ->actions([
                    amis()->VanillaAction()->actionType('cancel')->label(__('admin.cancel')),
                    amis()
                        ->VanillaAction()
                        ->type('submit')
                        ->label(__('admin.save'))
                        ->level('primary'),
                ])
                ->body($body);
        };

        return $this->baseCRUD()
            ->filter(
                $this->baseFilter()->body([
                    amis()->TextControl('keyword', __('admin.keyword'))->size('md'),
                ])
            )
            ->headerToolbar([
                amis()
                    ->DialogAction()
                    ->label(__('admin.create'))
                    ->icon('fa fa-add')
                    ->level('primary')
                    ->dialog(
                        $formDrawer()
                    ),
                amis()
                    ->DialogAction()
                    ->label(__('admin.code_generators.import_record'))
                    ->icon('fa fa-upload')
                    ->level('success')
                    ->dialog(
                        amis()->Dialog()->title(false)->body(
                            amis()->Form()->mode('normal')->body([
                                amis()
                                    ->TextareaControl('data')
                                    ->required()
                                    ->minRows(10)
                                    ->description(__('admin.code_generators.import_record_desc'))
                                    ->placeholder(__('admin.code_generators.import_record_placeholder')),
                            ])->api([
                                'url'    => '/dev_tools/code_generator',
                                'method' => 'post',
                                'data'   => '${DECODEJSON(data)}',
                            ])
                        )
                    ),
                ...$this->baseHeaderToolBar(),
            ])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('title', __('admin.code_generators.app_title')),
                amis()->TableColumn('table_name', __('admin.code_generators.table_name')),
                amis()->TableColumn('updated_at', __('admin.updated_at'))->sortable(),
                $this->rowActions([
                    amis()
                        ->AjaxAction()
                        ->label(__('admin.code_generators.generate_code'))
                        ->level('link')
                        ->confirmText(__('admin.code_generators.confirm_generate_code'))
                        ->api('/dev_tools/code_generator/generate?id=${id}')
                        ->feedback(
                            amis()->Dialog()->title(' ')->bodyClassName('overflow-auto')->body(amis()->Tpl()->tpl('${result | raw}'))->onEvent([
                                'confirm' => [
                                    'actions' => [
                                        ['actionType' => 'custom', 'script' => 'window.$owl.refreshRoutes()'],
                                    ],
                                ],
                                'cancel'  => [
                                    'actions' => [
                                        ['actionType' => 'custom', 'script' => 'window.$owl.refreshRoutes()'],
                                    ],
                                ],
                            ])
                        )
                        ->icon('fa fa-code'),
                    amis()
                        ->DialogAction()
                        ->label(__('admin.code_generators.copy_record'))
                        ->icon('fa fa-copy')
                        ->level('link')
                        ->dialog(
                            amis()->Dialog()->title(false)->body(
                                amis()
                                    ->Form()
                                    ->initApi('post:/dev_tools/code_generator/get_record?id=${id}')
                                    ->mode('normal')
                                    ->body(
                                        amis()
                                            ->TextareaControl('record')
                                            ->disabled()
                                            ->description(__('admin.code_generators.copy_record_description'))
                                    ),
                            )->actions([
                                amis()->VanillaAction()->actionType('cancel')->label(__('admin.cancel')),
                                amis()
                                    ->CopyAction()
                                    ->label(__('admin.copy'))
                                    ->level('success')
                                    ->content('${ENCODEJSON(record)}'),
                            ])
                        ),
                    amis()
                        ->DialogAction()
                        ->label(__('admin.code_generators.preview'))
                        ->icon('fa fa-eye')
                        ->level('link')
                        ->dialog(
                            $this->previewCodeDialog()
                        ),
                    amis()
                        ->DialogAction()
                        ->label(__('admin.edit'))
                        ->icon('fa-regular fa-pen-to-square')
                        ->level('link')
                        ->dialog(
                            $formDrawer(true)
                        ),
                    $this->rowDeleteButton(),
                ]),
            ]);
    }

    public function form()
    {
        $databaseColumns = Generator::make()->getDatabaseColumns();
        // 下划线的表名处理成驼峰文件名
        $nameHandler =
            'JOIN(ARRAYMAP(SPLIT(IF(ENDSWITH(table_name, "s"), LEFT(table_name, LEN(table_name) - 1), table_name), "_"), item=>CAPITALIZE(item)))';

        return amis()->Form()
            ->id('code_generator_form')
            ->wrapWithPanel(false)
            ->labelWidth(150)
            ->title(' ')
            ->mode('horizontal')
            ->resetAfterSubmit()
            ->data([
                'table_info'         => $databaseColumns,
                'table_primary_keys' => Generator::make()->getDatabasePrimaryKeys(),
            ])
            ->tabs([
                amis()->Tab()->title(__('admin.code_generators.base_info'))->body(
                    amis()->Card()->body(
                        amis()->GroupControl()->body([
                            amis()->GroupControl()->direction('vertical')->body([
                                amis()->GroupControl()->body([
                                    amis()
                                        ->TextControl('title', __('admin.code_generators.app_title'))
                                        ->required()
                                        ->onEvent([
                                            'change' => [
                                                'actions' => [
                                                    [
                                                        'actionType'  => 'setValue',
                                                        'componentId' => 'gen_menu_title',
                                                        'args'        => [
                                                            'value' => '${value}',
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ]),
                                ]),
                                amis()->GroupControl()->body([
                                    amis()->TextControl('table_name', __('admin.code_generators.table_name'))
                                        ->value()
                                        ->required()
                                        ->onEvent([
                                            'change' => [
                                                'actions' => [
                                                    [
                                                        'actionType'  => 'setValue',
                                                        'componentId' => 'gen_menu_route',
                                                        'args'        => [
                                                            'value' => '/${value}',
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ]),
                                    amis()
                                        ->SelectControl('exists_table', __('admin.code_generators.exists_table'))
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
                                                    [
                                                        'actionType'  => 'setValue',
                                                        'componentId' => 'gen_menu_route',
                                                        'args'        => [
                                                            'value' => '/${SPLIT(event.data.value, "-")[0]}',
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ]),
                                ]),
                                amis()->CheckboxesControl('needs', __('admin.code_generators.options'))
                                    ->joinValues(false)
                                    ->extractValue()
                                    ->checkAll()
                                    ->defaultCheckAll()
                                    ->options(Generator::make()->needCreateOptions()),
                                amis()
                                    ->TextControl('primary_key', __('admin.code_generators.primary_key'))
                                    ->value('id')
                                    ->description(__('admin.code_generators.primary_key_description'))
                                    ->required(),
                                amis()
                                    ->TextControl('model_name', __('admin.code_generators.model_name'))
                                    ->value($this->getNamespace('Models', 1) . '${' . $nameHandler . '}'),
                                amis()
                                    ->TextControl('controller_name',
                                        __('admin.code_generators.controller_name'))
                                    ->value($this->getNamespace('Controllers') . '${' . $nameHandler . '}Controller'),
                                amis()
                                    ->TextControl('service_name', __('admin.code_generators.service_name'))
                                    ->value($this->getNamespace('Services',
                                            1) . '${' . $nameHandler . '}Service'),
                                amis()
                                    ->SwitchControl('need_timestamps', 'CreatedAt & UpdatedAt')
                                    ->value(1),
                                amis()->SwitchControl('soft_delete', __('admin.soft_delete'))->value(1),
                            ]),
                        ]),
                    )
                ),
                amis()->Tab()->title(__('admin.code_generators.column_info'))->body($this->columnForm()),
                amis()->Tab()->title(__('admin.code_generators.route_config'))->body(
                    amis()->ComboControl('menu_info', false)->multiLine()->subFormMode('horizontal')->items([
                        amis()->SwitchControl('enabled', __('admin.code_generators.gen_route_menu'))->value(1),
                        amis()
                            ->TextControl('route', __('admin.code_generators.route'))
                            ->id('gen_menu_route')
                            ->required(),
                        amis()
                            ->TextControl('title', __('admin.code_generators.menu_name'))
                            ->id('gen_menu_title')
                            ->required(),
                        amis()->TreeSelectControl('parent_id', __('admin.code_generators.parent_menu'))
                            ->labelField('title')
                            ->valueField('id')
                            ->value(0)
                            ->options(AdminMenuService::make()->getTree()),
                        amis()->TextControl('icon', __('admin.code_generators.menu_icon'))
                            ->value('ph:circle')
                            ->description(
                                __('admin.admin_menu.icon_description') .
                                '<a href="https://icones.js.org/collection/all" target="_blank"> https://icones.js.org</a>'
                            ),
                    ])
                ),
                amis()->Tab()->title(__('admin.code_generators.page_config'))->body(
                    amis()->ComboControl('page_info', false)->multiLine()->subFormMode('horizontal')->items([
                        amis()->SwitchControl('dialog_form', __('admin.code_generators.dialog_form'))->value(1),
                        amis()->SelectControl('dialog_size', __('admin.code_generators.dialog_size'))
                            ->options(['xs', 'sm', 'md', 'lg', 'xl', 'full'])
                            ->value('md')
                            ->visibleOn('${!!dialog_form}'),
                        amis()->CheckboxesControl('row_actions', __('admin.actions'))->options([
                            'show'   => __('admin.show'),
                            'edit'   => __('admin.edit'),
                            'delete' => __('admin.delete'),
                        ])->checkAll()->defaultCheckAll()->joinValues(false)->extractValue(),
                    ])
                ),
            ]);
    }

    public function columnForm()
    {
        // 设置组件的 Tab
        $componentSchema = function ($title, $tips, $key) {
            return amis()->Tab()->title($title)->body([
                amis()->Alert()->level('info')->showIcon()->body($tips),
                amis()
                    ->SelectControl($key . '_type', __('admin.admin_menu.type'))
                    ->searchable()
                    ->clearable()
                    ->source('${component_options}')
                    ->onEvent([
                        'change' => [
                            'actions' => [
                                [
                                    'actionType' => 'clear',
                                    'componentId' => $key . '_property_id',
                                    'expression' => '${!!' . $key . '_property}'
                                ]
                            ],
                        ],
                    ])->description(__('admin.code_generators.name_label_desc')),
                amis()->Divider()->visibleOn('${!!' . $key . '_type}'),
                amis()
                    ->Service()
                    ->className('px-20')
                    ->initFetchSchemaOn('${!!' . $key . '_type}')
                    ->schemaApi('post:/dev_tools/code_generator/get_property_options?c=${' . $key . '_type}&t=' . $key),
            ]);
        };

        return amis()->Card()->body([
            amis()->Alert()
                ->body(__('admin.code_generators.column_warning') . " <a href='https://github.com/Slowlyo/owl-admin/issues/5' target='_blank'>" . __('admin.show') . "</a> ")
                ->level('warning')
                ->showCloseButton()
                ->showIcon(),
            amis()
                ->SubFormControl('columns', false)
                ->multiple()
                ->btnLabel('${"<div class=\'column-name\'>"+ name + "</div><div class=\'text-success\'>" + type +"</div><div class=\'item-comment\'>"+ comment +"</div>"}')
                ->minLength(1)
                ->draggable()
                ->addable()
                ->removable()
                ->itemClassName('custom-subform-item')
                ->addButtonText(__('admin.code_generators.add_column'))
                ->form(
                    amis()
                        ->FormControl()
                        ->set('title', __('admin.code_generators.add_column'))
                        ->size('lg')
                        ->id('column_form')
                        ->data([
                            'component_options' => $this->getComponentOptions(),
                        ])
                        ->tabs([
                            amis()->Tab()->title(__('admin.code_generators.base_info'))->body([
                                amis()->GroupControl()->body([
                                    amis()
                                        ->TextControl('name', __('admin.code_generators.column_name'))
                                        ->required(),
                                    amis()->SelectControl('type', __('admin.code_generators.type'))
                                        ->options(Generator::make()->availableFieldTypes())
                                        ->searchable()
                                        ->value('string')
                                        ->required(),
                                ]),

                                amis()->GroupControl()->body([
                                    amis()->TextControl('comment', __('admin.code_generators.comment'))->value(),
                                    amis()->TextControl('default', __('admin.code_generators.default_value')),
                                ]),

                                amis()->GroupControl()->body([
                                    amis()->TextControl('additional', __('admin.code_generators.extra_params'))
                                        ->labelRemark(
                                            __('admin.code_generators.remark1') .
                                            "<a href='https://learnku.com/docs/laravel/9.x/migrations/12248#b419dd' target='_blank'>" .
                                            __('admin.code_generators.remark2') .
                                            "</a>, " . __('admin.code_generators.remark3')
                                        ),
                                    amis()->SelectControl('column_index', __('admin.code_generators.index'))
                                        ->options(
                                            collect(['index', 'unique'])->map(fn($value) => [
                                                'label' => $value,
                                                'value' => $value,
                                            ]))
                                        ->clearable(),
                                ]),

                                amis()->SwitchControl('nullable', __('admin.code_generators.nullable'))->width(60),
                                amis()
                                    ->CheckboxesControl('action_scope', __('admin.code_generators.scope'))
                                    ->options([
                                        ['label' => __('admin.list'), 'value' => 'list'],
                                        ['label' => __('admin.detail'), 'value' => 'detail'],
                                        ['label' => __('admin.create'), 'value' => 'create'],
                                        ['label' => __('admin.edit'), 'value' => 'edit'],
                                    ])
                                    ->joinValues(false)
                                    ->extractValue()
                                    ->checkAll()
                                    ->defaultCheckAll(),
                            ]),

                            $componentSchema(
                                __('admin.code_generators.list_component'),
                                __('admin.code_generators.list_component_desc'),
                                'list_component'
                            ),
                            $componentSchema(
                                __('admin.code_generators.form_component'),
                                __('admin.code_generators.form_component_desc'),
                                'form_component'
                            ),
                            $componentSchema(
                                __('admin.code_generators.detail_component'),
                                __('admin.code_generators.detail_component_desc'),
                                'detail_component'
                            ),

                            amis()->Tab()->title(__('admin.code_generators.model_config'))->body([
                                amis()
                                    ->SwitchControl('file_column', __('admin.code_generators.file_column'))
                                    ->value(0)
                                    ->description(__('admin.code_generators.file_column_desc')),
                            ]),
                        ])
                ),
        ]);
    }

    public function previewCodeDialog()
    {
        return amis()->Dialog()->size('lg')->title(__('admin.code_generators.preview_code'))->body(
            amis()->Service()->api('post:/dev_tools/code_generator/preview?id=${id}')->body(
                amis()->Tabs()->tabs([
                    amis()->Tab()->title('Controller')->body(
                        amis()->EditorControl('controller')->language('php')->disabled()->size('xxl')
                    ),
                    amis()->Tab()->title('Service')->body(
                        amis()->EditorControl('service')->language('php')->disabled()->size('xxl')
                    ),
                    amis()->Tab()->title('Model')->body(
                        amis()->EditorControl('model')->language('php')->disabled()->size('xxl')
                    ),
                    amis()->Tab()->title('Migration')->body(
                        amis()->EditorControl('migration')->language('php')->disabled()->size('xxl')
                    ),
                ])
            )
        );
    }

    public function generate(Request $request)
    {
        $record = $this->service->getDetail($request->id);

        $needs          = collect($record->needs);
        $columns        = collect($record->columns);
        $successMessage = function ($type, $path) {
            return "<b class='text-success'>{$type} generated successfully!</b><br>{$path}<br><br>";
        };

        $paths   = [];
        $message = '';
        try {
            // Route
            RouteGenerator::handle($record->menu_info);

            // Model
            if ($needs->contains('need_model')) {
                $path = ModelGenerator::make()
                    ->title($record->title)
                    ->columns($columns)
                    ->primary($record->primary_key)
                    ->timestamps($record->need_timestamps)
                    ->softDelete($record->soft_delete)
                    ->generate($record->table_name, $record->model_name);

                $message .= $successMessage('Model', $path);

                $paths[] = $path;
            }

            // Migration
            $migratePath = '';
            if ($needs->contains('need_database_migration')) {
                $path = MigrationGenerator::make()
                    ->title($record->title)
                    ->primary($record->primary_key)
                    ->timestamps($record->need_timestamps)
                    ->softDelete($record->soft_delete)
                    ->generate($record->table_name, $columns);

                $message .= $successMessage('Migration', $path);
                $migratePath = str_replace(base_path(), '', $path);
                $paths[] = $path;
            }

            // Controller
            if ($needs->contains('need_controller')) {
                $path = ControllerGenerator::make()
                    ->title($record->title)
                    ->primary($record->primary_key)
                    ->title($record->title)
                    ->tableName($record->table_name)
                    ->pageInfo($record->page_info)
                    ->serviceName($record->service_name)
                    ->columns($columns)
                    ->timestamps($record->need_timestamps)
                    ->generate($record->controller_name);

                $message .= $successMessage('Controller', $path);

                $paths[] = $path;
            }

            // Service
            if ($needs->contains('need_service')) {
                $path = ServiceGenerator::make()
                    ->title($record->title)
                    ->generate($record->service_name, $record->model_name);

                $message .= $successMessage('Service', $path);

                $paths[] = $path;
            }

            // 创建数据库表
            if ($needs->contains('need_create_table')) {
                if($migratePath){
                    Artisan::call('migrate', ['--path' => $migratePath]);
                }else{
                    Artisan::call('migrate');
                }
                $message .= Artisan::output();
            }
        } catch (\Exception $e) {
            app('files')->delete($paths);

            return $this->response()->fail($e->getMessage());
        } catch (\Throwable $e) {
            app('files')->delete($paths);

            return $this->response()->fail($e->getMessage());
        }

        return $this->response()->doNotDisplayToast()->success(['result' => $message]);
    }

    public function preview(Request $request)
    {
        $record  = $this->service->getDetail($request->id);
        $columns = collect($record->columns);

        try {
            // Model
            $model = ModelGenerator::make()
                ->title($record->title)
                ->columns($columns)
                ->primary($record->primary_key)
                ->timestamps($record->need_timestamps)
                ->softDelete($record->soft_delete)
                ->preview($record->table_name, $record->model_name);

            // Migration
            $migration = MigrationGenerator::make()
                ->title($record->title)
                ->primary($record->primary_key)
                ->timestamps($record->need_timestamps)
                ->softDelete($record->soft_delete)
                ->setColumns($columns)
                ->preview($record->table_name);

            // Controller
            $controller = ControllerGenerator::make()
                ->primary($record->primary_key)
                ->title($record->title)
                ->tableName($record->table_name)
                ->pageInfo($record->page_info)
                ->serviceName($record->service_name)
                ->columns($columns)
                ->timestamps($record->need_timestamps)
                ->preview($record->controller_name);

            // Service
            $service = ServiceGenerator::make()
                ->title($record->title)
                ->preview($record->service_name, $record->model_name);
        } catch (\Exception $e) {
            return $this->response()->fail($e->getMessage());
        }

        return $this->response()->doNotDisplayToast()->success(compact('controller', 'service', 'model', 'migration'));
    }

    public function getComponentOptions()
    {
        return collect(get_class_methods(amis()))
            ->filter(fn($item) => $item != 'make')
            ->map(function ($item) {
                $renderer = new \ReflectionClass('\\Slowlyo\\OwlAdmin\\Renderers\\' . $item);
                $_doc     = $renderer->getDocComment();
                $_doc     = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $_doc);
                $_doc     = $_doc ? trim(str_replace('文档', '', $_doc)) : '';
                $label    = $_doc ? $item . ' - ' . $_doc : $item;

                return [
                    'label' => $label,
                    'value' => $item,
                ];
            })
            ->values()
            ->toArray();
    }

    public function getPropertyOptions(Request $request)
    {
        if (blank($request->c)) {
            return $this->response()->success([]);
        }

        $className = '\\Slowlyo\\OwlAdmin\\Renderers\\' . $request->c;

        $renderer = new \ReflectionClass($className);

        $exclude = ['__construct', '__call', 'set', 'jsonSerialize', 'toJson', 'toArray', 'name', 'label',];

        $options = collect($renderer->getMethods(\ReflectionMethod::IS_PUBLIC))
            ->map(function ($item) {
                $_doc = $item->getDocComment();
                $_doc = $_doc ? trim(str_replace(['/**', '*/', '*'], '', $_doc)) : false;

                return ['name' => $item->name, 'comment' => $_doc];
            })
            ->filter(fn($item) => !in_array($item['name'], $exclude))
            ->map(fn($item) => [
                'label' => trim(implode(' - ', [$item['name'], $item['comment']]), ' -'),
                'value' => $item['name'],
            ])
            ->values()
            ->toArray();

        $type = $request->t;

        $schema = amis()
            ->ComboControl($type . '_property', __('admin.code_generators.property'))
            ->id($type . '_property_id')
            ->multiple()
            ->visibleOn('${!!' . $type . '_type}')
            ->items([
                amis()
                    ->SelectControl('name', __('admin.code_generators.property_name'))
                    ->required()
                    ->set('unique', true)
                    ->searchable()
                    ->creatable()
                    ->size('md')
                    ->options($options),
                amis()->TextControl('value', __('admin.code_generators.value'))->size('md'),
            ]);

        return $this->response()->success($schema);
    }

    public function getRecord()
    {
        $record = $this->service->getDetail(request()->id)->makeHidden(['id', 'created_at', 'updated_at'])->toArray();

        return $this->response()->success(compact('record'));
    }

    public function getNamespace($name, $app = null): string
    {
        $namespace = collect(explode('\\', Admin::config('admin.route.namespace')));

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
