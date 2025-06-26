<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools\Traits;

use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\FilterGenerator;

/**
 * 代码生成器表单构建 Trait
 * 
 * 负责构建复杂的表单界面，包括：
 * - 主表单构建
 * - 字段表单构建
 * - 组件选择器构建
 */
trait CodeGeneratorFormTrait
{
    /**
     * 构建主表单
     *
     * @param bool $isEdit 是否为编辑模式
     * @return \Slowlyo\OwlAdmin\Renderers\Form
     */
    public function form($isEdit = false)
    {
        return amis()
            ->Form()
            ->promptPageLeave()
            ->id('code_generator_form')
            ->wrapWithPanel(false)
            ->labelWidth(150)
            ->title(' ')
            ->mode('horizontal')
            ->resetAfterSubmit()
            ->initApi('post:/dev_tools/code_generator/form_data')
            ->tabs([
                $this->buildBaseInfoTab($isEdit),
                $this->buildColumnInfoTab(),
                $this->buildRouteConfigTab(),
                $this->buildPageConfigTab(),
            ]);
    }

    /**
     * 构建基本信息标签页
     *
     * @param bool $isEdit
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildBaseInfoTab($isEdit)
    {
        $fillPathAction = $this->getFillPathAction();

        return amis()->Tab()->title(admin_trans('admin.code_generators.base_info'))->body(
            amis()->Card()->body(
                amis()->GroupControl()->body([
                    amis()->GroupControl()->direction('vertical')->body([
                        $this->buildTitleAndTableFields($fillPathAction),
                        $this->buildOptionsAndConfigFields($isEdit),
                        $this->buildPathFields(),
                        $this->buildTimestampFields($isEdit),
                    ]),
                ])
            )
        );
    }

    /**
     * 构建标题和表名字段
     *
     * @param array $fillPathAction
     * @return array
     */
    protected function buildTitleAndTableFields($fillPathAction)
    {
        return [
            amis()->GroupControl()->body([
                amis()
                    ->TextControl('title', admin_trans('admin.code_generators.app_title'))
                    ->required()
                    ->onEvent([
                        'change' => [
                            'actions' => [
                                [
                                    'actionType'  => 'setValue',
                                    'componentId' => 'gen_menu_title',
                                    'args'        => ['value' => '${value}'],
                                ],
                            ],
                        ],
                    ]),
            ]),
            amis()->GroupControl()->body([
                amis()
                    ->TextControl('table_name', admin_trans('admin.code_generators.table_name'))
                    ->value()
                    ->required()
                    ->onEvent([
                        'change' => [
                            'actions' => [
                                [
                                    'actionType'  => 'setValue',
                                    'componentId' => 'gen_menu_route',
                                    'args'        => ['value' => '/${value}'],
                                ],
                                $fillPathAction,
                            ],
                        ],
                    ]),
                amis()
                    ->SelectControl('exists_table', admin_trans('admin.code_generators.exists_table'))
                    ->searchable()
                    ->clearable()
                    ->selectMode('group')
                    ->source('${exists_tables}')
                    ->onEvent([
                        'change' => [
                            'actions' => [
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
                                    'args'        => ['value' => '/${SPLIT(event.data.value, "-")[0]}'],
                                ],
                                $fillPathAction,
                            ],
                        ],
                    ]),
            ]),
        ];
    }

    /**
     * 构建选项和配置字段
     *
     * @param bool $isEdit
     * @return array
     */
    protected function buildOptionsAndConfigFields($isEdit)
    {
        return [
            amis()
                ->CheckboxesControl('needs', admin_trans('admin.code_generators.options'))
                ->joinValues(false)
                ->extractValue()
                ->checkAll()
                ->defaultCheckAll()
                ->options(Generator::make()->needCreateOptions()),
            amis()
                ->TextControl('primary_key', admin_trans('admin.code_generators.primary_key'))
                ->value('id')
                ->description(admin_trans('admin.code_generators.primary_key_description'))
                ->required(),
            $this->buildSavePathSelector(),
        ];
    }

    /**
     * 构建保存路径选择器
     *
     * @return \Slowlyo\OwlAdmin\Renderers\SelectControl
     */
    protected function buildSavePathSelector()
    {
        $fillPathAction = $this->getFillPathAction();

        return amis()
            ->SelectControl('save_path', admin_trans('admin.code_generators.save_path_select'))
            ->clearable()
            ->searchable()
            ->description(admin_trans('admin.code_generators.save_path_select_tips'))
            ->selectMode('group')
            ->source('${save_path_options}')
            ->onEvent([
                'change' => [
                    'actions' => [
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
                        $fillPathAction,
                    ],
                ],
            ]);
    }

    /**
     * 构建路径字段
     *
     * @return array
     */
    protected function buildPathFields()
    {
        return [
            amis()->TextControl('model_name', admin_trans('admin.code_generators.model_name')),
            amis()->TextControl('controller_name', admin_trans('admin.code_generators.controller_name')),
            amis()->TextControl('service_name', admin_trans('admin.code_generators.service_name')),
        ];
    }

    /**
     * 构建时间戳字段
     *
     * @param bool $isEdit
     * @return array
     */
    protected function buildTimestampFields($isEdit)
    {
        return [
            amis()->SwitchControl('need_timestamps', 'CreatedAt & UpdatedAt')->value(1),
            amis()
                ->SwitchControl('list_display_created_at', admin_trans('admin.code_generators.list_display', ['content' => 'CreatedAt']))
                ->visibleOn('${need_timestamps}')
                ->value($isEdit ? '${page_info.list_display_created_at}' : '${need_timestamps}'),
            amis()
                ->SwitchControl('list_display_updated_at', admin_trans('admin.code_generators.list_display', ['content' => 'UpdatedAt']))
                ->visibleOn('${need_timestamps}')
                ->value($isEdit ? '${page_info.list_display_updated_at}' : '${need_timestamps}'),
            amis()->SwitchControl('soft_delete', admin_trans('admin.soft_delete'))->value(1),
        ];
    }

    /**
     * 获取填充路径的动作配置
     *
     * @return array
     */
    protected function getFillPathAction()
    {
        // 下划线的表名处理成驼峰文件名
        $nameHandler = 'JOIN(ARRAYMAP(SPLIT(IF(ENDSWITH(table_name, "s"), LEFT(table_name, LEN(table_name) - 1), table_name), "_"), item=>CAPITALIZE(item)))';
        
        return [
            'actionType'  => 'setValue',
            'componentId' => 'code_generator_form',
            'args'        => [
                'value' => [
                    'model_name'      => '${model_path}${' . $nameHandler . '}',
                    'controller_name' => '${controller_path}${' . $nameHandler . '}Controller',
                    'service_name'    => '${service_path}${' . $nameHandler . '}Service',
                ],
            ],
        ];
    }

    /**
     * 构建字段信息标签页
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildColumnInfoTab()
    {
        return amis()->Tab()->title(admin_trans('admin.code_generators.column_info'))->body([
            $this->cachedColumns(),
            $this->columnForm(),
        ]);
    }

    /**
     * 构建路由配置标签页
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildRouteConfigTab()
    {
        return amis()->Tab()->title(admin_trans('admin.code_generators.route_config'))->body(
            amis()->ComboControl('menu_info', false)->multiLine()->subFormMode('horizontal')->items([
                amis()->SwitchControl('enabled', admin_trans('admin.code_generators.gen_route_menu'))->value(1),
                amis()
                    ->TextControl('route', admin_trans('admin.code_generators.route'))
                    ->id('gen_menu_route')
                    ->required(),
                amis()
                    ->TextControl('title', admin_trans('admin.code_generators.menu_name'))
                    ->id('gen_menu_title')
                    ->required(),
                amis()
                    ->TreeSelectControl('parent_id', admin_trans('admin.code_generators.parent_menu'))
                    ->labelField('title')
                    ->valueField('id')
                    ->value(0)
                    ->source('${menu_tree}'),
                $this
                    ->iconifyPicker('icon', admin_trans('admin.code_generators.menu_icon'))
                    ->value('ph:circle'),
            ])
        );
    }

    /**
     * 构建页面配置标签页
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildPageConfigTab()
    {
        return amis()->Tab()->title(admin_trans('admin.code_generators.page_config'))->body(
            amis()->ComboControl('page_info', false)->multiLine()->subFormMode('horizontal')->items([
                amis()
                    ->RadiosControl('dialog_form', admin_trans('admin.code_generators.dialog_form'))
                    ->options([
                        ['label' => admin_trans('admin.code_generators.dialog'), 'value' => 'dialog'],
                        ['label' => admin_trans('admin.code_generators.drawer'), 'value' => 'drawer'],
                        ['label' => admin_trans('admin.code_generators.page'), 'value' => 'page'],
                    ])
                    ->selectFirst(),
                amis()
                    ->SelectControl('dialog_size', admin_trans('admin.code_generators.dialog_size'))
                    ->options(['xs', 'sm', 'md', 'lg', 'xl', 'full'])
                    ->value('md')
                    ->visibleOn('${dialog_form == "dialog"}'),
                amis()
                    ->SelectControl('dialog_size', admin_trans('admin.code_generators.drawer_size'))
                    ->options(['xs', 'sm', 'md', 'lg', 'full'])
                    ->value('md')
                    ->visibleOn('${dialog_form == "drawer"}'),
                amis()->CheckboxesControl('row_actions', admin_trans('admin.actions'))->options([
                    'create'       => admin_trans('admin.create'),
                    'show'         => admin_trans('admin.show'),
                    'edit'         => admin_trans('admin.edit'),
                    'delete'       => admin_trans('admin.delete'),
                    'batch_delete' => admin_trans('admin.batch_delete'),
                ])->checkAll()->defaultCheckAll()->joinValues(false)->extractValue(),
            ])
        );
    }
}
