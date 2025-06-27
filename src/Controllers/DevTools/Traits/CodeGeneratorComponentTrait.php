<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools\Traits;

use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\FilterGenerator;

/**
 * 代码生成器组件 Trait
 * 
 * 负责组件相关功能，包括：
 * - 字段表单构建
 * - 组件选择器构建
 * - 缓存字段管理
 */
trait CodeGeneratorComponentTrait
{
    /**
     * 字段表单
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Card
     */
    public function columnForm()
    {
        return amis()->Card()->body([
            $this->buildColumnWarningAlert(),
            $this->buildSubFormControl(),
        ]);
    }

    /**
     * 构建字段警告提示
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Alert
     */
    protected function buildColumnWarningAlert()
    {
        return amis()
            ->Alert()
            ->body(admin_trans('admin.code_generators.column_warning') . " <a href='https://github.com/Slowlyo/owl-admin/issues/5' target='_blank'>" . admin_trans('admin.show') . "</a> ")
            ->level('warning')
            ->showCloseButton()
            ->showIcon();
    }

    /**
     * 构建子表单控件
     *
     * @return \Slowlyo\OwlAdmin\Renderers\SubFormControl
     */
    protected function buildSubFormControl()
    {
        return amis()
            ->SubFormControl('columns', false)
            ->multiple()
            ->btnLabel('${"<div class=\'column-name\'>"+ name + "</div><div class=\'text-success\'>" + type +"</div><div class=\'item-comment\'>"+ comment +"</div>"}')
            ->minLength(1)
            ->draggable()
            ->addable()
            ->removable()
            ->itemClassName('custom-subform-item')
            ->addButtonText(admin_trans('admin.code_generators.add_column'))
            ->form($this->buildColumnFormTabs());
    }

    /**
     * 构建字段表单标签页
     *
     * @return \Slowlyo\OwlAdmin\Renderers\FormControl
     */
    protected function buildColumnFormTabs()
    {
        return amis()
            ->FormControl()
            ->set('title', admin_trans('admin.code_generators.add_column'))
            ->size('lg')
            ->id('column_form')
            ->tabs([
                $this->buildColumnBaseInfoTab(),
                $this->buildComponentTab('list_component', admin_trans('admin.code_generators.list_component'), admin_trans('admin.code_generators.list_component_desc')),
                $this->buildListFilterTab(),
                $this->buildComponentTab('form_component', admin_trans('admin.code_generators.form_component'), admin_trans('admin.code_generators.form_component_desc')),
                $this->buildComponentTab('detail_component', admin_trans('admin.code_generators.detail_component'), admin_trans('admin.code_generators.detail_component_desc')),
                $this->buildModelConfigTab(),
            ]);
    }

    /**
     * 构建字段基本信息标签页
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildColumnBaseInfoTab()
    {
        return amis()->Tab()->title(admin_trans('admin.code_generators.base_info'))->body([
            $this->buildColumnNameAndTypeGroup(),
            $this->buildColumnCommentAndDefaultGroup(),
            $this->buildColumnAdditionalAndIndexGroup(),
            $this->buildColumnOptionsGroup(),
        ]);
    }

    /**
     * 构建字段名称和类型组
     *
     * @return \Slowlyo\OwlAdmin\Renderers\GroupControl
     */
    protected function buildColumnNameAndTypeGroup()
    {
        return amis()->GroupControl()->body([
            amis()
                ->TextControl('name', admin_trans('admin.code_generators.column_name'))
                ->required(),
            amis()
                ->SelectControl('type', admin_trans('admin.code_generators.type'))
                ->options(Generator::make()->availableFieldTypes())
                ->searchable()
                ->value('string')
                ->required(),
        ]);
    }

    /**
     * 构建字段注释和默认值组
     *
     * @return \Slowlyo\OwlAdmin\Renderers\GroupControl
     */
    protected function buildColumnCommentAndDefaultGroup()
    {
        return amis()->GroupControl()->body([
            amis()
                ->TextControl('comment', admin_trans('admin.code_generators.comment'))
                ->value(),
            amis()->TextControl('default', admin_trans('admin.code_generators.default_value')),
        ]);
    }

    /**
     * 构建字段额外参数和索引组
     *
     * @return \Slowlyo\OwlAdmin\Renderers\GroupControl
     */
    protected function buildColumnAdditionalAndIndexGroup()
    {
        return amis()->GroupControl()->body([
            amis()
                ->TextControl('additional', admin_trans('admin.code_generators.extra_params'))
                ->labelRemark(
                    admin_trans('admin.code_generators.remark1') .
                        "<a href='https://learnku.com/docs/laravel/9.x/migrations/12248#b419dd' target='_blank'>" .
                        admin_trans('admin.code_generators.remark2') .
                        "</a>, " . admin_trans('admin.code_generators.remark3')
                ),
            amis()
                ->SelectControl('column_index', admin_trans('admin.code_generators.index'))
                ->options(
                    collect(['index', 'unique'])->map(fn($value) => [
                        'label' => $value,
                        'value' => $value,
                    ])
                )
                ->clearable(),
        ]);
    }

    /**
     * 构建字段选项组
     *
     * @return array
     */
    protected function buildColumnOptionsGroup()
    {
        return [
            amis()
                ->SwitchControl('nullable', admin_trans('admin.code_generators.nullable'))
                ->width(60),
            amis()
                ->CheckboxesControl('action_scope', admin_trans('admin.code_generators.scope'))
                ->options([
                    ['label' => admin_trans('admin.list'), 'value' => 'list'],
                    ['label' => admin_trans('admin.detail'), 'value' => 'detail'],
                    ['label' => admin_trans('admin.create'), 'value' => 'create'],
                    ['label' => admin_trans('admin.edit'), 'value' => 'edit'],
                ])
                ->joinValues(false)
                ->extractValue()
                ->checkAll()
                ->defaultCheckAll(),
        ];
    }

    /**
     * 构建组件标签页
     *
     * @param string $key
     * @param string $title
     * @param string $tips
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildComponentTab($key, $title, $tips)
    {
        return amis()->Tab()->title($title)->body([
            amis()->Alert()->level('info')->showIcon()->body($tips),
            amis()->Divider(),
            $this->componentSelect($key)->mode('normal'),
        ]);
    }

    /**
     * 构建列表筛选标签页
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildListFilterTab()
    {
        return amis()->Tab()->title(admin_trans('admin.code_generators.list_filter'))->body([
            amis()->ComboControl('list_filter')->items([
                amis()
                    ->SelectControl('type', admin_trans('admin.code_generators.filter_type'))
                    ->options(map2options(FilterGenerator::$filterMap))
                    ->required(),
                amis()
                    ->RadiosControl('mode', admin_trans('admin.code_generators.filter_mode'))
                    ->selectFirst()
                    ->options([
                        'fixed' => admin_trans('admin.code_generators.filter_mode_fixed'),
                        'input' => admin_trans('admin.code_generators.filter_mode_input'),
                    ]),
                amis()
                    ->TextControl('value', admin_trans('admin.code_generators.filter_mode_fixed_value'))
                    ->visibleOn('${mode == "fixed"}'),
                amis()
                    ->TextControl('input_name', admin_trans('admin.code_generators.filter_input_name'))
                    ->visibleOn('${mode == "input"}')
                    ->required(),
                amis()
                    ->TextControl('input_label', admin_trans('admin.code_generators.filter_input_label'))
                    ->visibleOn('${mode == "input"}'),
                $this
                    ->componentSelect('filter', admin_trans('admin.code_generators.filter_component'))
                    ->visibleOn('${mode == "input"}')
                    ->value([
                        'filter_type'     => 'TextControl',
                        'filter_property' => [
                            ['name' => 'size', 'value' => 'md'],
                            ['name' => 'clearable', 'value' => 1],
                        ],
                    ]),
            ])->multiple()->multiLine()->mode('normal'),
        ]);
    }

    /**
     * 构建模型配置标签页
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildModelConfigTab()
    {
        return amis()->Tab()->title(admin_trans('admin.code_generators.model_config'))->body([
            amis()
                ->SwitchControl('file_column', admin_trans('admin.code_generators.file_column'))
                ->value(0)
                ->description(admin_trans('admin.code_generators.file_column_desc')),
            amis()
                ->SwitchControl('file_column_multi', admin_trans('admin.code_generators.file_column_multi'))
                ->value(0)
                ->visibleOn('${file_column}'),
        ]);
    }

    /**
     * 缓存字段管理
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Flex
     */
    public function cachedColumns()
    {
        return amis()->Flex()->justify('end')->className('pb-3')->items([
            amis()
                ->DrawerAction()
                ->className('mr-3')
                ->label(admin_trans('admin.code_generators.common_field_add'))
                ->level('primary')
                ->drawer($this->buildCachedColumnsDrawer()),
        ]);
    }

    /**
     * 构建缓存字段抽屉
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Drawer
     */
    protected function buildCachedColumnsDrawer()
    {
        return amis()
            ->Drawer()
            ->title(admin_trans('admin.code_generators.load_config'))
            ->bodyClassName('p-0')
            ->actions([])
            ->id('load_config_dialog')
            ->closeOnOutside()
            ->body([
                amis()
                    ->Service()
                    ->name('common_field_service')
                    ->api('post:/dev_tools/code_generator/common_field/list')
                    ->body($this->buildCachedColumnsCRUD()),
            ]);
    }

    /**
     * 构建缓存字段CRUD表格
     *
     * @return \Slowlyo\OwlAdmin\Renderers\CRUDTable
     */
    protected function buildCachedColumnsCRUD()
    {
        return amis()
            ->CRUDTable()
            ->className('border-none')
            ->loadDataOnce()
            ->source('${common_field_list}')
            ->headerToolbar([
                amis()
                    ->DialogAction()
                    ->label(admin_trans('admin.code_generators.common_field_add_column'))
                    ->level('primary')
                    ->dialog($this->buildAddColumnDialog()),
            ])
            ->columns([
                amis()
                    ->TableColumn('name', admin_trans('admin.code_generators.config_name'))
                    ->searchable(),
                amis()
                    ->TableColumn('column_name', admin_trans('admin.code_generators.field_name'))
                    ->searchable(),
                amis()->Operation()->label(admin_trans('admin.actions'))->buttons([
                    $this->buildFillColumnButton(),
                    $this->buildDeleteColumnButton(),
                ])->set('width', 150),
            ]);
    }

    /**
     * 构建添加字段对话框
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Dialog
     */
    protected function buildAddColumnDialog()
    {
        return amis()
            ->Dialog()
            ->title(admin_trans('admin.code_generators.common_field_add_column'))
            ->body(
                amis()
                    ->Form()
                    ->reload('common_field_service')
                    ->api('post:/dev_tools/code_generator/common_field')
                    ->body([
                        amis()
                            ->TextControl('name', admin_trans('admin.code_generators.config_name'))
                            ->description(admin_trans('admin.code_generators.same_name_tips'))
                            ->required(),
                        amis()
                            ->SelectControl('column', admin_trans('admin.code_generators.field_config'))
                            ->valueField('name')
                            ->labelField('name')
                            ->source('${columns}')
                            ->menuTpl('<div>${name} (${comment})</div>')
                            ->required(),
                        amis()->HiddenControl('value')->value('${columns}'),
                    ])
            );
    }

    /**
     * 构建填充字段按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\VanillaAction
     */
    protected function buildFillColumnButton()
    {
        return amis()
            ->VanillaAction()
            ->label(admin_trans('admin.code_generators.fill'))
            ->level('primary')
            ->onEvent([
                'click' => [
                    'actions' => [
                        [
                            'actionType'  => 'setValue',
                            'componentId' => 'code_generator_form',
                            'args'        => [
                                'value' => [
                                    'columns' => '${CONCAT(columns, [value])}',
                                ],
                            ],
                        ],
                        [
                            'actionType'  => 'closeDialog',
                            'componentId' => 'load_config_dialog',
                        ],
                    ],
                ],
            ]);
    }

    /**
     * 构建删除字段按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\AjaxAction
     */
    protected function buildDeleteColumnButton()
    {
        return amis()
            ->AjaxAction()
            ->label(admin_trans('admin.delete'))
            ->level('danger')
            ->confirmText(admin_trans('admin.confirm_delete'))
            ->reload('common_field_service')
            ->api('post:/dev_tools/code_generator/common_field/del?name=${name}');
    }

    /**
     * 组件选择器
     *
     * @param string $key
     * @param string $label
     * @return \Slowlyo\OwlAdmin\Renderers\ComboControl
     */
    public function componentSelect($key, $label = '')
    {
        $comboName = $key . '_property';
        $comboId   = $comboName . '_id';

        return amis()->ComboControl($key, $label)->items([
            amis()
                ->Service()
                ->initFetchOn('${!!' . $key . '_type}')
                ->api('post:/dev_tools/code_generator/get_property_options?c=${' . $key . '_type}&t=' . $key)
                ->body([
                    $this->buildComponentSelectGroup($key, $comboName, $comboId),
                    $this->buildComponentPropertyCombo($comboName, $comboId),
                ]),
        ]);
    }

    /**
     * 构建组件选择组
     *
     * @param string $key
     * @param string $comboName
     * @param string $comboId
     * @return \Slowlyo\OwlAdmin\Renderers\GroupControl
     */
    protected function buildComponentSelectGroup($key, $comboName, $comboId)
    {
        return amis('group')->body([
            amis()
                ->SelectControl($key . '_type', admin_trans('admin.admin_menu.type'))
                ->searchable()
                ->id($key)
                ->clearable()
                ->size('lg')
                ->source('${component_options}')
                ->set('columnRatio', 8)
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
                ])->description(admin_trans('admin.code_generators.name_label_desc')),
            $this->buildComponentActionGroup($key, $comboName, $comboId),
        ]);
    }

    /**
     * 构建组件动作组
     *
     * @param string $key
     * @param string $comboName
     * @param string $comboId
     * @return \Slowlyo\OwlAdmin\Renderers\GroupControl
     */
    protected function buildComponentActionGroup($key, $comboName, $comboId)
    {
        return amis('group')->body([
            $this->buildLoadConfigDrawerAction($key, $comboName, $comboId),
            $this->buildSaveConfigDialogAction($key, $comboName),
        ])->set('columnRatio', 4);
    }

    /**
     * 构建加载配置抽屉动作
     *
     * @param string $key
     * @param string $comboName
     * @param string $comboId
     * @return \Slowlyo\OwlAdmin\Renderers\DrawerAction
     */
    protected function buildLoadConfigDrawerAction($key, $comboName, $comboId)
    {
        return amis()
            ->DrawerAction()
            ->label(admin_trans('admin.code_generators.load_config'))
            ->level('primary')
            ->set('columnRatio', 4)
            ->drawer(
                amis()
                    ->Drawer()
                    ->title(admin_trans('admin.code_generators.load_config'))
                    ->bodyClassName('p-0')
                    ->actions([])
                    ->id('load_config_dialog')
                    ->closeOnOutside()
                    ->body(
                        amis()
                            ->Service()
                            ->name('component_property_list_service')
                            ->api('post:/dev_tools/code_generator/component_property/list?key=' . $comboName . '&c=${' . $key . '_type}')
                            ->body($this->buildComponentPropertyTable($key, $comboId))
                    )
            );
    }

    /**
     * 构建保存配置对话框动作
     *
     * @param string $key
     * @param string $comboName
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    protected function buildSaveConfigDialogAction($key, $comboName)
    {
        return amis()
            ->DialogAction()
            ->label(admin_trans('admin.code_generators.save_current_config'))
            ->level('success')
            ->set('columnRatio', 8)
            ->dialog(
                amis()
                    ->Dialog()
                    ->title(admin_trans('admin.code_generators.save_current_config'))
                    ->body(
                        amis()
                            ->Form()
                            ->mode('normal')
                            ->api('post:/dev_tools/code_generator/component_property')
                            ->body([
                                amis()->HiddenControl('key')->value($comboName),
                                amis()->ComboControl('value')->items([
                                    amis()
                                        ->TextControl('label')
                                        ->inline(false)
                                        ->required()
                                        ->placeholder(admin_trans('admin.code_generators.input_config_name'))
                                        ->description(admin_trans('admin.code_generators.same_name_tips')),
                                    amis()->HiddenControl('key')->value('${' . $key . '_type}'),
                                    amis()->HiddenControl('value')->value('${' . $comboName . '}'),
                                ]),
                            ])
                    )
            );
    }

    /**
     * 构建组件属性表格
     *
     * @param string $key
     * @param string $comboId
     * @return \Slowlyo\OwlAdmin\Renderers\CRUDTable
     */
    protected function buildComponentPropertyTable($key, $comboId)
    {
        return amis()
            ->CRUDTable()
            ->className('border-none')
            ->loadDataOnce()
            ->source('${component_property_list}')
            ->columns([
                amis()
                    ->TableColumn('label', admin_trans('admin.admin_role.name'))
                    ->searchable(),
                amis()
                    ->Operation()
                    ->label(admin_trans('admin.actions'))
                    ->buttons([
                        $this->buildFillPropertyButton($key, $comboId),
                        $this->buildDeletePropertyButton(),
                    ])
                    ->set('width', 150),
            ]);
    }

    /**
     * 构建填充属性按钮
     *
     * @param string $key
     * @param string $comboId
     * @return \Slowlyo\OwlAdmin\Renderers\VanillaAction
     */
    protected function buildFillPropertyButton($key, $comboId)
    {
        return amis()
            ->VanillaAction()
            ->label(admin_trans('admin.code_generators.fill'))
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
            ]);
    }

    /**
     * 构建删除属性按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\AjaxAction
     */
    protected function buildDeletePropertyButton()
    {
        return amis()
            ->AjaxAction()
            ->label(admin_trans('admin.delete'))
            ->level('danger')
            ->confirmText(admin_trans('admin.confirm_delete'))
            ->reload('component_property_list_service')
            ->api('post:/dev_tools/code_generator/component_property/del?name=${name}&label=${label}&key=${key}');
    }

    /**
     * 构建组件属性组合控件
     *
     * @param string $comboName
     * @param string $comboId
     * @return \Slowlyo\OwlAdmin\Renderers\ComboControl
     */
    protected function buildComponentPropertyCombo($comboName, $comboId)
    {
        return amis()
            ->ComboControl($comboName, admin_trans('admin.code_generators.property'))
            ->id($comboId)
            ->multiple()
            ->strictMode(false)
            ->items([
                amis()
                    ->TextControl('name', admin_trans('admin.code_generators.property_name'))
                    ->required()
                    ->set('unique', true)
                    ->size('md')
                    ->clearable()
                    ->source('${component_property_options}'),
                amis()->TextControl('value', admin_trans('admin.code_generators.value'))->size('md'),
            ]);
    }
}
