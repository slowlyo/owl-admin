<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\Services\AdminMenuService;
use Slowlyo\OwlAdmin\Traits\IconifyPickerTrait;
use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;
use Slowlyo\OwlAdmin\Services\AdminCodeGeneratorService;
use Slowlyo\OwlAdmin\Support\CodeGenerator\GenCodeClear;

/**
 * @property AdminCodeGeneratorService $service
 */
class CodeGeneratorController extends AdminController
{
    use IconifyPickerTrait;

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
                ->Drawer()
                ->size('xl')
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
                amis()->DrawerAction()
                    ->label(__('admin.create'))
                    ->icon('fa fa-add')
                    ->level('primary')
                    ->drawer($form()),
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
                amis()->TableColumn('menu_info.route', __('admin.code_generators.route')),
                amis()->TableColumn('updated_at', __('admin.updated_at'))->sortable(),
                $this->rowActions([
                    $this->generateCodeAction(),
                    $this->previewCodeAction(),
                    amis()->DrawerAction()
                        ->label(__('admin.edit'))
                        ->icon('fa-regular fa-pen-to-square')
                        ->level('link')
                        ->drawer($form(true)),
                    $this->copyRecordAction(),
                    $this->clearCodeAction(),
                    $this->rowDeleteButton()->className('text-danger'),
                ]),
            ]);
    }

    public function form()
    {
        // 下划线的表名处理成驼峰文件名
        $nameHandler = 'JOIN(ARRAYMAP(SPLIT(IF(ENDSWITH(table_name, "s"), LEFT(table_name, LEN(table_name) - 1), table_name), "_"), item=>CAPITALIZE(item)))';

        return amis()->Form()
            ->promptPageLeave()
            ->id('code_generator_form')
            ->wrapWithPanel(false)
            ->labelWidth(150)
            ->title(' ')
            ->mode('horizontal')
            ->resetAfterSubmit()
            ->initApi('post:/dev_tools/code_generator/form_data')
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
                                        ->source('${exists_tables}')
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
                                    ->value('${default_path}')
                                    ->selectMode('group')
                                    ->source('${save_path_options}')
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
                            ->source('${menu_tree}'),
                        $this->iconifyPicker('icon', __('admin.code_generators.menu_icon'))->value('ph:circle'),
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
        $result = Generator::make()->generate($request->id, explode(',', $request->needs));

        return $this->response()->doNotDisplayToast()->success(compact('result'));
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
        $data = Generator::make()->preview($request->id);

        return $this->response()->doNotDisplayToast()->success($data);
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
                'label' => $item['name'],
                'value' => $item['name'],
            ])
            ->values()
            ->toArray();

        return $this->response()->success(['component_property_options' => $options]);
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
        admin_abort_if(!data_get($request->value, 'key'), __('admin.required', ['attribute' => __('admin.admin_menu.component')]));

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
        $component_property_list = collect(settings()->get($request->key))->values();

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

    public function formData($directReturn = false)
    {
        $databaseColumns = Generator::make()->getDatabaseColumns();

        $defaultPath = $this->service->getDefaultPath();

        $savePaths = [$defaultPath];
        foreach (Admin::extension()->all() as $extension) {
            $property    = $extension->composerProperty;
            $namespace   = str_replace('\\', "/", array_key_first($property->get('autoload.psr-4')));
            $alias       = $extension->getAlias();
            $savePaths[] = [
                'label' => __("admin.code_generators.save_path_label_prefix") . (empty($alias) ? $extension->getName() : $alias),
                'value' => [
                    'controller_path' => $namespace . 'Http/Controllers/',
                    'service_path'    => $namespace . 'Services/',
                    'model_path'      => $namespace . 'Models/',
                ],
            ];
        }

        $existsTables = $databaseColumns->map(function ($item, $index) {
            return [
                'label'    => $index,
                'children' => $item->keys()->map(function ($item) use ($index) {
                    return ['value' => $item . '-' . $index, 'label' => $item];
                }),
            ];
        })->values();

        $data = [
            'table_info'         => $databaseColumns,
            'table_primary_keys' => Generator::make()->getDatabasePrimaryKeys(),
            'default_path'       => $defaultPath,
            'model_path'         => $defaultPath['value']['model_path'],
            'service_path'       => $defaultPath['value']['service_path'],
            'controller_path'    => $defaultPath['value']['controller_path'],
            'exists_tables'      => $existsTables,
            'menu_tree'          => AdminMenuService::make()->getTree(),
            'save_path_options'  => $savePaths,
            'component_options'  => $this->service->getComponentOptions(),
        ];

        if($directReturn){
            return $data;
        }

        return $this->response()->success($data);
    }

    /**
     * 字段表单
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Card
     */
    public function columnForm()
    {
        // 设置组件的 Tab
        $componentSchema = function ($title, $tips, $key) {
            $comboName = $key . '_property';
            $comboId   = $comboName . '_id';

            return amis()->Tab()->title($title)->body([
                amis()->Alert()->level('info')->showIcon()->body($tips),

                amis()->Flex()->justify('end')->items([
                    amis()->DrawerAction()
                        ->className('mr-3')
                        ->label(__('admin.code_generators.load_config'))
                        ->level('primary')
                        ->drawer(
                            amis()->Drawer()
                                ->title(__('admin.code_generators.load_config'))
                                ->bodyClassName('p-0')
                                ->actions([])
                                ->id('load_config_dialog')
                                ->closeOnOutside()
                                ->body(
                                    amis()->Service()
                                        ->name('component_property_list_service')
                                        ->api('post:/dev_tools/code_generator/component_property/list?key=' . $comboName . '&c=${' . $key . '_type}')
                                        ->body(
                                            amis()
                                                ->CRUDTable()
                                                ->className('border-0')
                                                ->loadDataOnce()
                                                ->source('${component_property_list}')
                                                ->columns([
                                                    amis()
                                                        ->TableColumn('label', __('admin.admin_role.name'))
                                                        ->searchable(),

                                                    amis()->Operation()->label(__('admin.actions'))->buttons([
                                                        // 填充
                                                        amis()->VanillaAction()
                                                            ->label(__('admin.code_generators.fill'))
                                                            ->level('primary')
                                                            ->onEvent([
                                                                'click' => [
                                                                    'actions' => [
                                                                        [
                                                                            'actionType'  => 'setValue',
                                                                            'componentId' => $comboId,
                                                                            'args'        => ['value' => '${value}'],
                                                                        ],
                                                                        [
                                                                            'actionType'  => 'setValue',
                                                                            'componentId' => $key,
                                                                            'args'        => ['value' => '${key}'],
                                                                        ],
                                                                        [
                                                                            'actionType'  => 'closeDialog',
                                                                            'componentId' => 'load_config_dialog',
                                                                        ],
                                                                    ],
                                                                ],
                                                            ]),

                                                        // 删除
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

                    amis()->DialogAction()
                        ->label(__('admin.code_generators.save_current_config'))
                        ->level('success')
                        ->dialog(
                            amis()->Dialog()->title(__('admin.code_generators.save_current_config'))->body(
                                amis()
                                    ->Form()
                                    ->mode('normal')
                                    ->api('post:/dev_tools/code_generator/component_property')
                                    ->body([
                                        amis()->HiddenControl('key')->value($comboName),
                                        amis()->ComboControl('value')->items([
                                            amis()->TextControl('label')
                                                ->inline(false)
                                                ->required()
                                                ->placeholder(__('admin.code_generators.input_config_name'))
                                                ->description(__('admin.code_generators.same_name_tips')),
                                            amis()->HiddenControl('key')->value('${' . $key . '_type}'),
                                            amis()->HiddenControl('value')->value('${' . $comboName . '}'),
                                        ]),
                                    ])
                            )
                        ),
                ]),

                amis()->Divider(),

                amis()->Service()
                    ->className('px-20')
                    ->initFetchOn('${!!' . $key . '_type}')
                    ->api('post:/dev_tools/code_generator/get_property_options?c=${' . $key . '_type}&t=' . $key)
                    ->body([
                        amis()->SelectControl($key . '_type', __('admin.admin_menu.type'))
                            ->searchable()
                            ->id($key)
                            ->clearable()
                            ->source('${component_options}')
                            ->onEvent([
                                'change' => [
                                    'actions' => [
                                        [
                                            'actionType'  => 'clear',
                                            'componentId' => $comboId,
                                            'expression'  => '${!!' . $comboName . '}',
                                        ],
                                    ],
                                ],
                            ])->description(__('admin.code_generators.name_label_desc')),

                        amis()->ComboControl($comboName, __('admin.code_generators.property'))
                            ->id($comboId)
                            ->multiple()
                            ->strictMode(false)
                            ->items([
                                amis()->TextControl('name', __('admin.code_generators.property_name'))
                                    ->required()
                                    ->set('unique', true)
                                    ->size('md')
                                    ->clearable()
                                    ->source('${component_property_options}'),
                                amis()->TextControl('value', __('admin.code_generators.value'))->size('md'),
                            ]),
                    ]),
            ]);
        };

        return amis()->Card()->body([
            amis()->Alert()
                ->body(__('admin.code_generators.column_warning') . " <a href='https://github.com/Slowlyo/owl-admin/issues/5' target='_blank'>" . __('admin.show') . "</a> ")
                ->level('warning')
                ->showCloseButton()
                ->showIcon(),
            amis()->SubFormControl('columns', false)
                ->multiple()
                ->btnLabel('${"<div class=\'column-name\'>"+ name + "</div><div class=\'text-success\'>" + type +"</div><div class=\'item-comment\'>"+ comment +"</div>"}')
                ->minLength(1)
                ->draggable()
                ->addable()
                ->removable()
                ->itemClassName('custom-subform-item')
                ->addButtonText(__('admin.code_generators.add_column'))
                ->form(
                    amis()->FormControl()
                        ->set('title', __('admin.code_generators.add_column'))
                        ->size('lg')
                        ->id('column_form')
                        ->tabs([
                            // 基本信息
                            amis()->Tab()->title(__('admin.code_generators.base_info'))->body([
                                amis()->GroupControl()->body([
                                    amis()->TextControl('name', __('admin.code_generators.column_name'))
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
                                amis()->CheckboxesControl('action_scope', __('admin.code_generators.scope'))
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
                            // 列表组件
                            $componentSchema(
                                __('admin.code_generators.list_component'),
                                __('admin.code_generators.list_component_desc'),
                                'list_component'
                            ),
                            // 表单组件
                            $componentSchema(
                                __('admin.code_generators.form_component'),
                                __('admin.code_generators.form_component_desc'),
                                'form_component'
                            ),
                            // 详情组件
                            $componentSchema(
                                __('admin.code_generators.detail_component'),
                                __('admin.code_generators.detail_component_desc'),
                                'detail_component'
                            ),
                            // 模型配置
                            amis()->Tab()->title(__('admin.code_generators.model_config'))->body([
                                amis()->SwitchControl('file_column', __('admin.code_generators.file_column'))
                                    ->value(0)
                                    ->description(__('admin.code_generators.file_column_desc')),
                            ]),
                        ])
                ),
        ]);
    }

    /**
     * 预览代码 按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function previewCodeAction()
    {
        $editorTab = function ($column) {
            return amis()->Tab()->title(Str::title($column))->body(
                amis()->EditorControl($column)->language('php')->disabled()->size('xxl')
            );
        };

        return amis()->DialogAction()
            ->label(__('admin.code_generators.preview'))
            ->icon('fa fa-eye')
            ->level('link')
            ->dialog(
                amis()->Dialog()->size('lg')->title(__('admin.code_generators.preview_code'))->body(
                    amis()->Service()->api('post:/dev_tools/code_generator/preview?id=${id}')->body(
                        amis()->Tabs()->tabs([
                            $editorTab('controller'),
                            $editorTab('service'),
                            $editorTab('model'),
                            $editorTab('migration'),
                        ])
                    )
                )
            );
    }

    /**
     * 复制记录 按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function copyRecordAction()
    {
        return amis()->DialogAction()
            ->label(__('admin.code_generators.copy_record'))
            ->icon('fa fa-copy')
            ->level('link')
            ->dialog(
                amis()->Dialog()->title(false)->body(
                    amis()->Form()
                        ->initApi('post:/dev_tools/code_generator/get_record?id=${id}')
                        ->mode('normal')
                        ->body(
                            amis()->TextareaControl('record')
                                ->disabled()
                                ->description(__('admin.code_generators.copy_record_description'))
                        ),
                )->actions([
                    amis()->VanillaAction()->actionType('cancel')->label(__('admin.cancel')),
                    amis()->CopyAction()
                        ->label(__('admin.copy'))
                        ->level('success')
                        ->content('${ENCODEJSON(record)}'),
                ])
            );
    }

    /**
     * 生成代码 按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function generateCodeAction()
    {
        return amis()->DialogAction()
            ->level('link')
            ->icon('fa fa-code')
            ->label(__('admin.code_generators.generate_code'))
            ->iconClassName('pr-4')
            ->dialog(
                amis()->Dialog()->title(__('admin.code_generators.select_generate_record'))->body([
                    amis()->Form()->api('post:/dev_tools/code_generator/generate?id=${id}')->mode('normal')->body([
                        amis()->CheckboxesControl('needs')
                            ->checkAll()
                            ->inline(false)
                            ->required()
                            ->options(Generator::make()->needCreateOptions()),
                    ])->feedback(
                        amis()->Dialog()->title(' ')->bodyClassName('overflow-auto')
                            ->size('lg')
                            ->body(amis()->Tpl()->tpl('${result | raw}'))
                            ->onEvent([
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
                    ),
                ])
            );
    }

    /**
     * 清除代码 按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function clearCodeAction()
    {
        return amis()->DialogAction()
            ->level('link')
            ->icon('fa fa-brush')
            ->label(__('admin.code_generators.clear_code'))
            ->className('text-danger')
            ->dialog(
                amis()->Dialog()->title(__('admin.code_generators.select_clear_record'))->body([
                    amis()->Form()->api('post:/dev_tools/code_generator/clear?id=${id}')->mode('normal')->body([
                        amis()->CheckboxesControl('selected')
                            ->checkAll()
                            ->inline(false)
                            ->required()
                            ->menuTpl('<div><div class="font-bold">${label}</div><div class="text-sm text-gray-400">${content}</div></div>')
                            ->source('post:/dev_tools/code_generator/gen_record_options?id=${id}'),
                    ])->onEvent([
                        'submitSucc' => [
                            'actions' => [['actionType' => 'custom', 'script' => 'window.$owl.refreshRoutes()']],
                        ],
                    ]),
                ])
            );
    }

    /**
     * 清除代码
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function clear()
    {
        GenCodeClear::make()->handle(request()->all());

        return $this->response()->successMessage(__('admin.action_success'));
    }

    /**
     * 获取生成的内容
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function genRecordOptions()
    {
        $list = GenCodeClear::make()->getRecord(request('id'));

        $options = collect($list)->except(['menu_id'])->map(fn($item, $index) => [
            'label'   => Str::headline($index),
            'value'   => $index,
            'content' => is_array($item) ? implode("\n", $item) : $item,
            'hidden'  => blank($item),
        ])->values();

        return $this->response()->success($options);
    }

    public function edit($id)
    {
        if ($this->actionOfGetData()) {
            $data = $this->service->getEditData($id)->toArray();

            $data = array_merge($data, $this->formData(true));

            return $this->response()->success($data);
        }

        return parent::edit($id);
    }

    /**
     * 页面样式
     *
     * @return array[]
     */
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
