<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Slowlyo\OwlAdmin\Traits\IconifyPickerTrait;
use Slowlyo\OwlAdmin\Controllers\AdminController;
use Slowlyo\OwlAdmin\Services\AdminCodeGeneratorService;
use Slowlyo\OwlAdmin\Controllers\DevTools\Traits\CodeGeneratorFormTrait;
use Slowlyo\OwlAdmin\Controllers\DevTools\Traits\CodeGeneratorActionsTrait;
use Slowlyo\OwlAdmin\Controllers\DevTools\Traits\CodeGeneratorComponentTrait;
use Slowlyo\OwlAdmin\Controllers\DevTools\Traits\CodeGeneratorConfigTrait;

/**
 * 代码生成器控制器
 * 
 * 负责代码生成器的主要功能，包括：
 * - CRUD 基础操作
 * - 代码生成、预览、清除
 * - 组件和字段配置管理
 * - 复杂表单界面构建
 * 
 * @property AdminCodeGeneratorService $service
 */
class CodeGeneratorController extends AdminController
{
    use IconifyPickerTrait;
    use CodeGeneratorFormTrait;
    use CodeGeneratorActionsTrait;
    use CodeGeneratorComponentTrait;
    use CodeGeneratorConfigTrait;

    protected string $serviceName = AdminCodeGeneratorService::class;

    /**
     * 主页面入口
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->list());
        }

        return $this->response()->success(
            $this->basePage()->css($this->css())->body($this->list())
        );
    }

    /**
     * 构建列表页面
     *
     * @return \Slowlyo\OwlAdmin\Renderers\CRUDTable
     */
    public function list()
    {
        return $this
            ->baseCRUD()
            ->filter($this->buildListFilter())
            ->headerToolbar($this->buildHeaderToolbar())
            ->columns($this->buildTableColumns());
    }

    /**
     * 构建列表筛选器
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Form
     */
    protected function buildListFilter()
    {
        return $this->baseFilter()->body([
            amis()->TextControl('title', admin_trans('admin.code_generators.app_title'))
                ->size('md')
                ->clearable()
                ->placeholder(admin_trans('admin.code_generators.app_title')),
            amis()->TextControl('table_name', admin_trans('admin.code_generators.table_name'))
                ->size('md')
                ->clearable()
                ->placeholder(admin_trans('admin.code_generators.table_name')),
        ]);
    }

    /**
     * 构建头部工具栏
     *
     * @return array
     */
    protected function buildHeaderToolbar()
    {
        return [
            $this->buildCreateDrawerAction(),
            $this->buildImportDialogAction(),
            ...$this->baseHeaderToolBar(),
        ];
    }

    /**
     * 构建创建抽屉动作
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DrawerAction
     */
    protected function buildCreateDrawerAction()
    {
        return amis()
            ->DrawerAction()
            ->label(admin_trans('admin.create'))
            ->icon('fa fa-add')
            ->level('primary')
            ->drawer($this->buildFormDrawer(false));
    }

    /**
     * 构建导入对话框动作
     *
     * @return \Slowlyo\OwlAdmin\Renderers\DialogAction
     */
    protected function buildImportDialogAction()
    {
        return amis()
            ->DialogAction()
            ->label(admin_trans('admin.code_generators.import_record'))
            ->icon('fa fa-upload')
            ->level('success')
            ->dialog(
                amis()->Dialog()->title(false)->body(
                    amis()->Form()->mode('normal')->body([
                        amis()
                            ->TextareaControl('data')
                            ->required()
                            ->minRows(10)
                            ->description(admin_trans('admin.code_generators.import_record_desc'))
                            ->placeholder(admin_trans('admin.code_generators.import_record_placeholder')),
                    ])->api([
                        'url'    => '/dev_tools/code_generator',
                        'method' => 'post',
                        'data'   => '${DECODEJSON(data)}',
                    ])
                )
            );
    }

    /**
     * 构建表格列
     *
     * @return array
     */
    protected function buildTableColumns()
    {
        return [
            amis()->TableColumn('id', 'ID')->sortable(),
            amis()->TableColumn('title', admin_trans('admin.code_generators.app_title')),
            amis()->TableColumn('table_name', admin_trans('admin.code_generators.table_name')),
            amis()->TableColumn('menu_info.route', admin_trans('admin.code_generators.route')),
            amis()->TableColumn('updated_at', admin_trans('admin.updated_at'))->sortable(),
            $this->buildRowActions(),
        ];
    }

    /**
     * 构建行动作
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Operation
     */
    protected function buildRowActions()
    {
        return $this->rowActions([
            $this->generateCodeAction(),
            $this->previewCodeAction(),
            amis()
                ->DrawerAction()
                ->label(admin_trans('admin.edit'))
                ->level('link')
                ->drawer($this->buildFormDrawer(true)),
            $this->rowDeleteButton(),
            amis()->DropdownButton()->label(admin_trans('admin.more'))->level('link')->buttons([
                $this->cloneAction(),
                $this->copyRecordAction(),
                $this->clearCodeAction(),
            ]),
        ]);
    }

    /**
     * 构建表单抽屉
     *
     * @param bool $isEdit 是否为编辑模式
     * @return \Slowlyo\OwlAdmin\Renderers\Drawer
     */
    protected function buildFormDrawer($isEdit = false)
    {
        $body = $this->form($isEdit);

        if ($isEdit) {
            $body = $body->initApi($this->getEditGetDataPath())->api($this->getUpdatePath());
        } else {
            $body = $body->api($this->getStorePath());
        }

        return amis()
            ->Drawer()
            ->size('xl')
            ->title($isEdit ? admin_trans('admin.edit') : admin_trans('admin.create'))
            ->actions([
                amis()->VanillaAction()->actionType('cancel')->label(admin_trans('admin.cancel')),
                amis()
                    ->VanillaAction()
                    ->type('submit')
                    ->label(admin_trans('admin.save'))
                    ->level('primary'),
            ])
            ->body($body);
    }

    /**
     * 页面样式配置
     *
     * @return array
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
                'border-radius' => 'var(--borderRadius)',
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
            '.border-none'                                   => [
                'border' => 'none !important',
            ],
        ];
    }
}
