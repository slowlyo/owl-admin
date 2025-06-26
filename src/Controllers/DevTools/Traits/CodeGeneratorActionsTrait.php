<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Support\CodeGenerator\Generator;
use Slowlyo\OwlAdmin\Support\CodeGenerator\GenCodeClear;

/**
 * 代码生成器动作 Trait
 * 
 * 负责各种动作按钮和相关功能，包括：
 * - 代码生成、预览、清除
 * - 记录克隆、复制
 * - 动作按钮构建
 */
trait CodeGeneratorActionsTrait
{
    /**
     * 生成代码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function generate(Request $request)
    {
        $result = Generator::make()->generate($request->id, safe_explode(',', $request->needs));

        return $this->response()->doNotDisplayToast()->success(compact('result'));
    }

    /**
     * 预览代码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function preview(Request $request)
    {
        $data = Generator::make()->preview($request->id);

        return $this->response()->doNotDisplayToast()->success($data);
    }

    /**
     * 清除代码
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function clear()
    {
        GenCodeClear::make()->handle(request()->all());

        return $this->response()->successMessage(admin_trans('admin.action_success'));
    }

    /**
     * 克隆记录
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function clone()
    {
        $this->service->clone(request()->all());

        return $this->response()->successMessage(admin_trans('admin.action_success'));
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
     * 获取生成的内容选项
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

    /**
     * 生成代码按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function generateCodeAction()
    {
        return amis()
            ->DialogAction()
            ->level('link')
            ->label(admin_trans('admin.code_generators.generate_code'))
            ->iconClassName('pr-4')
            ->dialog(
                amis()->Dialog()->title(admin_trans('admin.code_generators.select_generate_record'))->body([
                    amis()->Form()->api('post:/dev_tools/code_generator/generate?id=${id}')->mode('normal')->body([
                        amis()
                            ->CheckboxesControl('needs')
                            ->checkAll()
                            ->inline(false)
                            ->required()
                            ->options(Generator::make()->needCreateOptions()),
                    ])->feedback(
                        amis()
                            ->Dialog()->title(' ')->bodyClassName('overflow-auto')
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
     * 预览代码按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function previewCodeAction()
    {
        return amis()
            ->DialogAction()
            ->label(admin_trans('admin.code_generators.preview'))
            ->level('link')
            ->dialog(
                amis()->Dialog()->size('lg')->title(admin_trans('admin.code_generators.preview_code'))->body(
                    amis()->Service()->api('post:/dev_tools/code_generator/preview?id=${id}')->body(
                        amis()->Tabs()->tabs([
                            $this->buildEditorTab('controller'),
                            $this->buildEditorTab('service'),
                            $this->buildEditorTab('model'),
                            $this->buildEditorTab('migration'),
                        ])
                    )
                )
            );
    }

    /**
     * 清除代码按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function clearCodeAction()
    {
        return amis()
            ->DialogAction()
            ->level('link')
            ->label(admin_trans('admin.code_generators.clear_code'))
            ->dialog(
                amis()->Dialog()->size('md')->title(admin_trans('admin.code_generators.select_clear_record'))->body([
                    amis()->Form()->api('post:/dev_tools/code_generator/clear?id=${id}')->mode('normal')->body([
                        amis()
                            ->CheckboxesControl('selected')
                            ->checkAll()
                            ->inline(false)
                            ->required()
                            ->itemClassName('py-4 relative')
                            ->menuTpl('<div class="absolute pt-4 top-0 left-6 h-full w-full"><div class="font-bold">${label}</div><div class="break-words break-all text-sm text-gray-400">${content}</div></div>')
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
     * 克隆记录按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function cloneAction()
    {
        return amis()
            ->DialogAction()
            ->label(admin_trans('admin.code_generators.clone_record'))
            ->level('link')
            ->dialog(
                amis()->Dialog()->title(admin_trans('admin.code_generators.clone_record'))->body([
                    amis()->Form()->wrapWithPanel(false)->api('post:/dev_tools/code_generator/clone')->body([
                        amis()->HiddenControl('id'),
                        amis()
                            ->TextControl('table_name', admin_trans('admin.code_generators.new_table_name'))
                            ->required(),
                        amis()->TextControl('title', admin_trans('admin.code_generators.new_app_title'))->required(),
                    ]),
                ])
            );
    }

    /**
     * 复制记录按钮
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    public function copyRecordAction()
    {
        return amis()
            ->DialogAction()
            ->label(admin_trans('admin.code_generators.copy_record'))
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
                                ->description(admin_trans('admin.code_generators.copy_record_description'))
                        ),
                )->actions([
                    amis()->VanillaAction()->actionType('cancel')->label(admin_trans('admin.cancel')),
                    amis()
                        ->CopyAction()
                        ->label(admin_trans('admin.copy'))
                        ->level('success')
                        ->content('${ENCODEJSON(record)}'),
                ])
            );
    }

    /**
     * 构建编辑器标签页
     *
     * @param string $column
     * @return \Slowlyo\OwlAdmin\Renderers\Tab
     */
    protected function buildEditorTab($column)
    {
        return amis()->Tab()->title(Str::title($column))->body(
            amis()->EditorControl($column)->language('php')->disabled()->size('xxl')
        );
    }
}
