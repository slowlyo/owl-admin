<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;
use Slowlyo\OwlAdmin\Services\AdminCodeGeneratorService;
use Slowlyo\OwlAdmin\Support\CodeGenerator\ModelGenerator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\RouteGenerator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\ServiceGenerator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\MigrationGenerator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\ControllerGenerator;

/**
 * @property AdminCodeGeneratorService $service
 */
class CodeGeneratorController extends AdminController
{
    use Schema\CodeGeneratorSchema;

    protected string $serviceName = AdminCodeGeneratorService::class;

    public function index()
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->list());
        }

        return $this->response()->success(
            amis()->Page()->css($this->css())->body($this->list())
        );
    }

    public function list()
    {
        $form = function ($isEdit = false) {
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
                    amis()->VanillaAction()
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
                amis()->DialogAction()
                    ->label(__('admin.create'))
                    ->icon('fa fa-add')
                    ->level('primary')
                    ->dialog($form()),
                amis()->DialogAction()
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
                    $this->generateCodeAction(),
                    $this->copyRecordAction(),
                    $this->previewCodeAction(),
                    amis()->DialogAction()
                        ->label(__('admin.edit'))
                        ->icon('fa-regular fa-pen-to-square')
                        ->level('link')
                        ->dialog($form(true)),
                    $this->rowDeleteButton(),
                ]),
            ]);
    }

    public function form()
    {
        $databaseColumns = Generator::make()->getDatabaseColumns();

        // 下划线的表名处理成驼峰文件名
        $nameHandler = 'JOIN(ARRAYMAP(SPLIT(IF(ENDSWITH(table_name, "s"), LEFT(table_name, LEN(table_name) - 1), table_name), "_"), item=>CAPITALIZE(item)))';
        $currentModule = Admin::currentModule();

        $defaultPath = [
            'label' => $currentModule ?: __('admin.code_generators.save_path_dir'),
            'value' => [
                'controller_path' => $this->getNamespace('Controllers'),
                'service_path'    => $this->getNamespace('Services', 1),
                'model_path'      => $this->getNamespace('Models', 1),
            ],
        ];

        $paths = [$defaultPath];
        foreach (Admin::extension()->all() as $extension) {
            $property  = $extension->composerProperty;
            $namespace = str_replace('\\', "/", array_key_first($property->get('autoload.psr-4')));
            $alias     = $extension->getAlias();
            $paths[]   = [
                'label' => __("admin.code_generators.save_path_label_prefix") . (empty($alias) ? $extension->getName() : $alias),
                'value' => [
                    'controller_path' => $namespace . 'Http/Controllers/',
                    'service_path'    => $namespace . 'Services/',
                    'model_path'      => $namespace . 'Models/',
                ],
            ];
        }

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
                'model_path'         => $defaultPath['value']['model_path'],
                'service_path'       => $defaultPath['value']['service_path'],
                'controller_path'    => $defaultPath['value']['controller_path'],
            ])
            ->tabs([
                // 基本信息
                amis()->Tab()->title(__('admin.code_generators.base_info'))->body(
                    amis()->Card()->body(
                        amis()->GroupControl()->body([
                            amis()->GroupControl()->direction('vertical')->body([
                                amis()->GroupControl()->body([
                                    amis()->TextControl('title', __('admin.code_generators.app_title'))
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
                                    amis()->SelectControl('exists_table', __('admin.code_generators.exists_table'))
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
                                amis()->SelectControl('save_path', __('admin.code_generators.save_path_select'))
                                    ->searchable()
                                    ->description(__('admin.code_generators.save_path_select_tips'))
                                    ->clearable()
                                    ->value($defaultPath)
                                    ->selectMode('group')
                                    ->options($paths)
                                    ->onEvent([
                                        'change' => [
                                            'actions' => [
                                                // 更新 table_name 的值
                                                [
                                                    'actionType'  => 'setValue',
                                                    'componentId' => 'code_generator_form',
                                                    'args'        => [
                                                        'value' => [
                                                            'controller_path' => '${event.data.value.controller_path}',
                                                            'service_path'    => '${event.data.value.service_path}',
                                                            'model_path'      => '${event.data.value.model_path}',
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ]),
                                amis()
                                    ->TextControl('model_name', __('admin.code_generators.model_name'))
                                    ->value('${model_path}${' . $nameHandler . '}'),
                                amis()
                                    ->TextControl('controller_name',
                                        __('admin.code_generators.controller_name'))
                                    ->value('${controller_path}${' . $nameHandler . '}Controller'),
                                amis()
                                    ->TextControl('service_name', __('admin.code_generators.service_name'))
                                    ->value('${service_path}${' . $nameHandler . '}Service'),
                                amis()
                                    ->SwitchControl('need_timestamps', 'CreatedAt & UpdatedAt')
                                    ->value(1),
                                amis()->SwitchControl('soft_delete', __('admin.soft_delete'))->value(1),
                            ]),
                        ]),
                    )
                ),
                // 字段信息
                amis()->Tab()->title(__('admin.code_generators.column_info'))->body($this->columnForm()),
                // 路由配置
                amis()->Tab()->title(__('admin.code_generators.route_config'))->body(
                    amis()->ComboControl('menu_info', false)->multiLine()->subFormMode('horizontal')->items([
                        amis()->SwitchControl('enabled', __('admin.code_generators.gen_route_menu'))->value(1),
                        amis()->TextControl('route', __('admin.code_generators.route'))
                            ->id('gen_menu_route')
                            ->required(),
                        amis()->TextControl('title', __('admin.code_generators.menu_name'))
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
                // 页面配置
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

    /**
     * 生成代码
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
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
                    ->generate($record->table_name, $columns, $record->model_name);

                $message     .= $successMessage('Migration', $path);
                $migratePath = str_replace(base_path(), '', $path);
                $paths[]     = $path;
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
            // Route
            RouteGenerator::handle($record->menu_info);
            // 创建数据库表
            if ($needs->contains('need_create_table')) {
                if ($migratePath) {
                    Artisan::call('migrate', ['--path' => $migratePath]);
                } else {
                    Artisan::call('migrate');
                }
                $message .= Artisan::output();
            }
        } catch (\Throwable $e) {
            app('files')->delete($paths);

            RouteGenerator::refresh();

            return $this->response()->fail($e->getMessage());
        }

        return $this->response()->doNotDisplayToast()->success(['result' => $message]);
    }

    /**
     * 预览代码
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
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

    /**
     * 获取所有组件
     *
     * @return mixed
     */
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

    /**
     * 获取组件属性
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     * @throws \ReflectionException
     */
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

        $comboName = $type . '_property';
        $comboId   = $comboName . '_id';

        $schema = amis()
            ->ComboControl($comboName, __('admin.code_generators.property'))
            ->id($comboId)
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

        $cacheAction = amis()->Flex()->justify('start')->items([
            amis()->DialogAction()
                ->className('mr-3')
                ->label(__('admin.code_generators.load_config'))
                ->level('primary')
                ->dialog(
                    amis()->Dialog()
                        ->title(__('admin.code_generators.load_component_config', ['c' => $request->c]))
                        ->actions([])
                        ->id('load_config_dialog')
                        ->closeOnOutside()
                        ->body(
                            amis()->Service()
                                ->name('component_property_list_service')
                                ->api('post:/dev_tools/code_generator/component_property/list?key=' . $comboName . '&c=' . $request->c)
                                ->body(
                                    amis()->Table()->source('${component_property_list}')->columns([
                                        amis()->TableColumn('label'),

                                        amis()->Operation()->buttons([
                                            amis()->VanillaAction()
                                                ->label(__('admin.code_generators.fill'))
                                                ->level('primary')
                                                ->onEvent([
                                                    'click' => [
                                                        'actions' => [
                                                            [
                                                                'actionType'  => 'setValue',
                                                                'componentId' => $comboId,
                                                                'args'        => ['value' => '${value}',],
                                                            ],
                                                            [
                                                                'actionType'  => 'closeDialog',
                                                                'componentId' => 'load_config_dialog',
                                                            ],
                                                        ],
                                                    ],
                                                ]),

                                            amis()->AjaxAction()
                                                ->label(__('admin.delete'))
                                                ->level('danger')
                                                ->confirmText(__('admin.confirm_delete'))
                                                ->reload('component_property_list_service')
                                                ->api('post:/dev_tools/code_generator/component_property/del?name=' . $comboName),
                                        ])->set('width', 150),
                                    ])
                                )
                        )
                ),

            amis()->DialogAction()->label(__('admin.code_generators.save_current_config'))->level('success')->dialog(
                amis()->Dialog()->title(__('admin.code_generators.save_current_config'))->body(
                    amis()->Form()->mode('normal')->api('post:/dev_tools/code_generator/component_property')->body([
                        amis()->HiddenControl('key')->value($comboName),
                        amis()->ComboControl('value')->items([
                            amis()->TextControl('label')
                                ->inline(false)
                                ->required()
                                ->placeholder(__('admin.code_generators.input_config_name'))
                                ->description(__('admin.code_generators.same_name_tips')),
                            amis()->HiddenControl('key')->value($request->c),
                            amis()->HiddenControl('value')->value('${' . $comboName . '}'),
                        ]),
                    ])
                )
            ),
        ]);

        $line = amis()->Divider();

        return $this->response()->success([$schema, $line, $cacheAction]);
    }

    /**
     * 保存组件配置
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function saveComponentProperty(Request $request)
    {
        $list = [];

        if ($original = settings()->get($request->key)) {
            foreach ($original as $item) {
                $list[$item['key'] . '|' . $item['label']] = $item;
            }
        }

        $list[$request->value['key'] . '|' . $request->value['label']] = $request->value;

        $res = settings()->set($request->key, array_values($list));

        return $this->autoResponse($res, __('admin.save'));
    }

    /**
     * 获取组件配置
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function getComponentProperty(Request $request)
    {
        $component_property_list = collect(settings()->get($request->key))->where('key', $request->c)->values();

        return $this->response()->success(compact('component_property_list'));
    }

    /**
     * 删除组件配置
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function delComponentProperty(Request $request)
    {
        $list = settings()->get($request->name);

        if (blank($list)) {
            return $this->autoResponse(false);
        }

        foreach ($list as $key => $item) {
            if ($item['label'] == $request->label && $item['key'] == $request->key) {
                unset($list[$key]);
            }
        }

        settings()->set($request->name, array_values($list));

        return $this->autoResponse(true);
    }

    /**
     * 获取记录
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function getRecord()
    {
        $record = $this->service->getDetail(request()->id)->makeHidden(['id', 'created_at', 'updated_at'])->toArray();

        return $this->response()->success(compact('record'));
    }

    /**
     * 获取命名空间
     *
     * @param $name
     * @param $app
     *
     * @return string
     */
    public function getNamespace($name, $app = null): string
    {
        $namespace = collect(explode('\\', Admin::config('admin.route.namespace')));

        $namespace->pop();

        if ($app && !Admin::currentModule()) {
            $namespace->pop();
        }

        return $namespace->push($name)->implode('/') . '/';
    }
}
