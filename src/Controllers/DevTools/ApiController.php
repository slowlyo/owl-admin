<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Support\Str;
use Slowlyo\OwlAdmin\Support\Cores\Api;
use Slowlyo\OwlAdmin\Services\AdminApiService;
use Slowlyo\OwlAdmin\Support\Apis\AdminBaseApi;
use Slowlyo\OwlAdmin\Controllers\AdminController;

/**
 * @property AdminApiService $service
 */
class ApiController extends AdminController
{
    protected string $serviceName = AdminApiService::class;

    public function list()
    {
        $crud = $this
            ->baseCRUD()
            ->filter($this->baseFilter()->body([
                amis()->TextControl('title', admin_trans('admin.apis.title'))
                    ->size('md')
                    ->clearable()
                    ->placeholder(admin_trans('admin.apis.title')),
                amis()->TextControl('path', admin_trans('admin.apis.path'))
                    ->size('md')
                    ->clearable()
                    ->placeholder(admin_trans('admin.apis.path')),
            ]))
            ->headerToolbar([
                $this->createButton(true, 'lg'),
                ...$this->baseHeaderToolBar(),
                $this->appTemplateBtn(),
            ])
            ->columns([
                amis()->TableColumn('id', 'ID')->sortable(),
                amis()->TableColumn('title', admin_trans('admin.apis.title')),
                amis()->TableColumn('path', admin_trans('admin.apis.path')),
                amis()->TableColumn('template_title', admin_trans('admin.apis.template')),
                amis()->TableColumn('enabled', admin_trans('admin.apis.enabled'))->quickEdit(
                    amis()->SwitchControl()->mode('inline')->saveImmediately(true)
                ),
                amis()->TableColumn('updated_at', admin_trans('admin.updated_at'))->type('datetime')->sortable(true),
                $this->rowActions([
                    $this->rowEditButton(true, 'lg'),
                    $this->rowDeleteButton(),
                    $this->previewAction(),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function previewAction()
    {
        return amis()
            ->DialogAction()
            ->label(admin_trans('admin.preview'))
            ->size('md')
            ->level('link')
            ->visibleOn('${method == "get" && enabled}')
            ->dialog(
                amis()
                    ->Dialog()
                    ->title(admin_trans('admin.preview'))
                    ->actions([])
                    ->closeOnOutside()
                    ->closeOnEsc()
                    ->body([
                        amis()->Service()->api('/${path}')->body([
                            amis()->Json()->source('${&}')->levelExpand(3),
                        ]),
                    ])
            );
    }

    public function appTemplateBtn()
    {
        return amis()
            ->DialogAction()
            ->label(admin_trans('admin.apis.add_template'))
            ->level('success')
            ->icon('fa fa-upload')
            ->dialog(
                amis()->Dialog()->title(admin_trans('admin.apis.add_template'))->body([
                    amis()->Form()->mode('normal')->api('/dev_tools/api/add_template')->body([
                        amis()
                            ->TextareaControl('template')
                            ->required()
                            ->minRows(10)
                            ->description(admin_trans('admin.apis.add_template_tips'))
                            ->placeholder(admin_trans('admin.apis.paste_template')),
                        amis()->SwitchControl('overlay', admin_trans('admin.apis.overlay'))->value(1),
                    ]),
                ])
            );
    }

    /**
     * 添加模板
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function addTemplate()
    {
        $template  = request('template');
        $className = Str::between($template, 'class ', ' extends AdminBaseApi');
        if (!$className) {
            $className = Str::between($template, 'class ', ' extends \Slowlyo\OwlAdmin\Support\Apis\AdminBaseApi');
        }

        admin_abort_if(!$className, admin_trans('admin.apis.template_format_error'));

        $file = Api::path($className . '.php');

        admin_abort_if(is_file($file) && !request('overlay'), admin_trans('admin.apis.template_exists'));

        try {
            $dir = dirname($file);

            if (!is_dir($dir)) {
                app('files')->makeDirectory($dir, 0755, true);
            }

            app('files')->put($file, $template);
        } catch (\Throwable $e) {
            return $this->response()->fail(admin_trans('admin.save_failed'));
        }

        return $this->response()->successMessage(admin_trans('admin.save_success'));
    }

    public function form()
    {
        return $this->baseForm()->body([
            amis()->TextControl('title', admin_trans('admin.apis.title'))->required(),
            amis()->TextControl('path', admin_trans('admin.apis.path'))->required(),
            amis()->SwitchControl('enabled', admin_trans('admin.apis.enabled'))->value(1),
            amis()
                ->SelectControl('template', admin_trans('admin.apis.template'))
                ->required()
                ->searchable()
                ->source('/dev_tools/api/templates'),
            amis()
                ->ComboControl('args', admin_trans('admin.apis.args'))
                ->visibleOn('${template}')
                ->multiLine()
                ->strictMode(false)
                ->items([
                    amis()->Service()->initFetch()->schemaApi('get:/dev_tools/api/args_schema?template=${template}'),
                ]),
        ]);
    }


    public function detail($id)
    {
        return $this->baseDetail()->body([]);
    }

    public function template()
    {
        $apis = collect(Admin::context()->apis)
            ->filter(fn($item) => (new \ReflectionClass($item))->isSubclassOf(AdminBaseApi::class))
            ->map(fn($item) => [
                'label' => app($item)->getMethod() . ' - ' . app($item)->getTitle(),
                'value' => $item,
            ]);

        return $this->response()->success($apis);
    }

    public function argsSchema()
    {
        $schema = app(request('template'))->argsSchema();

        if (blank($schema)) {
            $schema = null;
        }

        return $this->response()->success($schema);
    }
}
