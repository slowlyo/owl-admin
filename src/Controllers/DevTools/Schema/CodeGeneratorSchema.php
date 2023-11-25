<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools\Schema;

use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;

/**
 * 代码生成器的部分页面结构
 */
trait CodeGeneratorSchema
{
    /**
     * 字段表单
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Card
     */
    public function columnForm()
    {
        // 设置组件的 Tab
        $componentSchema = function ($title, $tips, $key) {
            return amis()->Tab()->title($title)->body([
                amis()->Alert()->level('info')->showIcon()->body($tips),
                amis()->SelectControl($key . '_type', __('admin.admin_menu.type'))
                    ->searchable()
                    ->clearable()
                    ->source('${component_options}')
                    ->onEvent([
                        'change' => [
                            'actions' => [
                                [
                                    'actionType'  => 'clear',
                                    'componentId' => $key . '_property_id',
                                    'expression'  => '${!!' . $key . '_property}',
                                ],
                            ],
                        ],
                    ])->description(__('admin.code_generators.name_label_desc')),
                amis()->Divider()->visibleOn('${!!' . $key . '_type}'),
                amis()->Service()
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
                        ->data(['component_options' => $this->getComponentOptions()])
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
     * @return \Slowlyo\OwlAdmin\Renderers\AjaxAction
     */
    public function generateCodeAction()
    {
        return amis()->AjaxAction()
            ->level('link')
            ->icon('fa fa-code')
            ->label(__('admin.code_generators.generate_code'))
            ->api('/dev_tools/code_generator/generate?id=${id}')
            ->confirmText(__('admin.code_generators.confirm_generate_code'))
            ->feedback(
                amis()->Dialog()->title(' ')->bodyClassName('overflow-auto')->body(amis()
                    ->Tpl()
                    ->tpl('${result | raw}'))->onEvent([
                    'confirm' => [
                        'actions' => [['actionType' => 'custom', 'script' => 'window.$owl.refreshRoutes()']],
                    ],
                    'cancel'  => [
                        'actions' => [['actionType' => 'custom', 'script' => 'window.$owl.refreshRoutes()']],
                    ],
                ])
            );
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
