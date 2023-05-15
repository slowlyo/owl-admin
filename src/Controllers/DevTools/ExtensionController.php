<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Renderers\Tpl;
use Slowlyo\OwlAdmin\Renderers\Form;
use Slowlyo\OwlAdmin\Renderers\Card;
use Slowlyo\OwlAdmin\Renderers\Alert;
use Slowlyo\OwlAdmin\Renderers\Dialog;
use Slowlyo\OwlAdmin\Extend\Extension;
use Slowlyo\OwlAdmin\Renderers\Drawer;
use Slowlyo\OwlAdmin\Renderers\Wrapper;
use Slowlyo\OwlAdmin\Renderers\Divider;
use Slowlyo\OwlAdmin\Renderers\Service;
use Slowlyo\OwlAdmin\Renderers\Markdown;
use Slowlyo\OwlAdmin\Renderers\CRUDCards;
use Slowlyo\OwlAdmin\Renderers\CRUDTable;
use Slowlyo\OwlAdmin\Renderers\AjaxAction;
use Slowlyo\OwlAdmin\Renderers\TextControl;
use Slowlyo\OwlAdmin\Renderers\FileControl;
use Slowlyo\OwlAdmin\Renderers\TableColumn;
use Slowlyo\OwlAdmin\Renderers\DialogAction;
use Slowlyo\OwlAdmin\Renderers\DrawerAction;
use Slowlyo\OwlAdmin\Renderers\SchemaPopOver;
use Slowlyo\OwlAdmin\Controllers\AdminController;

class ExtensionController extends AdminController
{
    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index()
    {
        if ($this->actionOfGetData()) {
            $data = [];
            foreach (Admin::extension()->all() as $extension) {
                $data[] = $this->each($extension);
            }

            return $this->response()->success(['rows' => $data]);
        }

        $page = $this->basePage()->body($this->list());

        return $this->response()->success($page);
    }

    protected function each($extension)
    {
        $property = $extension->composerProperty;

        $name    = $extension->getName();
        $version = $extension->getVersion();

        return [
            'id'          => $name,
            'alias'       => $extension->getAlias(),
            'logo'        => $extension->getLogoBase64(),
            'name'        => $name,
            'version'     => $version,
            'description' => $property->description,
            'authors'     => $property->authors,
            'homepage'    => $property->homepage,
            'enabled'     => $extension->enabled(),
            'extension'   => $extension,
            'doc'         => $extension->getDocs(),
            'has_setting' => $extension->settingForm() instanceof Form,
            'used'        => $extension->used(),
        ];
    }

    public function list()
    {
        return CRUDCards::make()
            ->perPage(20)
            ->affixHeader(false)
            ->filterTogglable()
            ->filterDefaultVisible(false)
            ->api($this->getListGetDataPath())
            ->perPageAvailable([10, 20, 30, 50, 100, 200])
            ->footerToolbar(['switch-per-page', 'statistics', 'pagination'])
            ->loadDataOnce()
            ->source('${rows | filter:alias:match:keywords}')
            ->filter(
                $this->baseFilter()->body([
                    TextControl::make()
                        ->name('keywords')
                        ->label(__('admin.extensions.form.name'))
                        ->placeholder(__('admin.extensions.filter_placeholder'))
                        ->size('md'),
                ])
            )
            ->headerToolbar([
                $this->createExtend(),
                $this->localInstall(),
                $this->moreExtend(),
                amis('reload')->align('right'),
                amis('filter-toggler')->align('right'),
            ])->card(
                Card::make()->header([
                    'title'           => '${alias || "-" | truncate: 8}',
                    'subTitle'        => '${name}',
                    'avatar'          => '${logo || "https://slowlyo.gitee.io/owl-admin-doc/static/logo.png"}',
                    'avatarClassName' => 'pull-left thumb-md avatar m-r',
                ])->body([
                    amis()->label(__('admin.extensions.card.author'))
                        ->type('tpl')
                        ->tpl('${authors[0].name} < <span class="text-info">${authors[0].email}</span> >'),
                    amis()->label(__('admin.extensions.card.version'))->name('version')->visibleOn('${version}'),
                    amis()->label(__('admin.extensions.card.homepage'))
                        ->type('tpl')
                        ->tpl('<a href="${homepage}" target="_blank">${homepage | truncate:30}</a>'),
                    amis()->label(__('admin.extensions.card.status'))
                        ->name('enabled')
                        ->type('status')
                        ->labelMap([
                            __('admin.extensions.status_map.disabled'),
                            __('admin.extensions.status_map.enabled'),
                        ]),
                    Wrapper::make()->size('none')->body(
                        DrawerAction::make()->label('README.md')->className('p-0')->level('link')->drawer(
                            Drawer::make()
                                ->size('lg')
                                ->title('README.md')
                                ->actions([])
                                ->closeOnOutside()
                                ->closeOnEsc()
                                ->body(Markdown::make()->name('${doc | raw}')->options([
                                    'html'   => true,
                                    'breaks' => true,
                                ]))
                        )
                    ),
                    Divider::make(),
                    Tpl::make()->tpl('${description|truncate: 500}')->popOver(
                        SchemaPopOver::make()->trigger('hover')->body(
                            Tpl::make()->tpl('${description}')
                        )->position('left-top')
                    ),
                ])->toolbar([
                    DialogAction::make()
                        ->label(__('admin.extensions.setting'))
                        ->level('link')
                        ->visibleOn('${has_setting && enabled}')
                        ->dialog(
                            Dialog::make()->title(__('admin.extensions.setting'))->body(
                                Service::make()
                                    ->schemaApi([
                                        'url'    => admin_url('dev_tools/extensions/config_form'),
                                        'method' => 'post',
                                        'data'   => [
                                            'id' => '${id}',
                                        ],
                                    ])
                            )->actions([amis('submit')->label(__('admin.save'))->level('primary')])
                        ),
                    AjaxAction::make()
                        ->label('${enabled ? "' . __('admin.extensions.disable') . '" : "' . __('admin.extensions.enable') . '"}')
                        ->className([
                            "text-success" => '${!enabled}',
                            "text-danger"  => '${enabled}',
                        ])
                        ->api([
                            'url'    => admin_url('dev_tools/extensions/enable'),
                            'method' => 'post',
                            'data'   => [
                                'id'      => '${id}',
                                'enabled' => '${enabled}',
                            ],
                        ])
                        ->confirmText('${enabled ? "' . __('admin.extensions.disable_confirm') . '" : "' . __('admin.extensions.enable_confirm') . '"}'),
                    AjaxAction::make()
                        ->label(__('admin.extensions.uninstall'))
                        ->className('text-danger')
                        ->api([
                            'url'    => admin_url('dev_tools/extensions/uninstall'),
                            'method' => 'post',
                            'data'   => [
                                'id' => '${id}',
                            ],
                        ])
                        ->visibleOn('${used}')
                        ->confirmText(__('admin.extensions.uninstall_confirm')),
                ])
            );
    }

    /**
     * 创建扩展
     *
     * @return DialogAction
     */
    public function createExtend()
    {
        return DialogAction::make()
            ->label(__('admin.extensions.create_extension'))
            ->icon('fa fa-add')
            ->level('success')
            ->dialog(
                Dialog::make()->title(__('admin.extensions.create_extension'))->body(
                    Form::make()->mode('normal')->api($this->getStorePath())->body([
                        Alert::make()
                            ->level('info')
                            ->showIcon()
                            ->body(__('admin.extensions.create_tips', ['dir' => config('admin.extension.dir')])),
                        TextControl::make()
                            ->name('name')
                            ->label(__('admin.extensions.form.name'))
                            ->placeholder('eg: slowlyo/owl-admin')
                            ->required(),
                        TextControl::make()
                            ->name('namespace')
                            ->label(__('admin.extensions.form.namespace'))
                            ->placeholder('eg: Slowlyo\Notice')
                            ->required(),
                    ])
                )
            );
    }

    public function store(Request $request)
    {
        $extension = Extension::make();

        $extension->createDir($request->name, $request->namespace);

        if ($extension->hasError()) {
            return $this->response()->fail($extension->getError());
        }

        return $this->response()->successMessage(
            __('admin.successfully_message', ['attribute' => __('admin.extensions.create')])
        );
    }

    /**
     * 本地安装
     *
     * @return DialogAction
     */
    public function localInstall()
    {
        return DialogAction::make()
            ->label(__('admin.extensions.local_install'))
            ->icon('fa-solid fa-cloud-arrow-up')
            ->dialog(
                Dialog::make()->title(__('admin.extensions.local_install'))->showErrorMsg(false)->body(
                    Form::make()->mode('normal')->api('post:' . admin_url('dev_tools/extensions/install'))->body([
                        FileControl::make()->name('file')->label()->required()->drag()->accept('.zip'),
                    ])
                )
            );
    }

    /**
     * 获取更多扩展
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function more()
    {
        $q   = request('q');
        // 加速
        $url = 'http://admin-packagist.dev.slowlyo.top?q=' . $q;

        $result = file_get_contents($url);

        // 如果哪天加速服务挂了，就用官方的
        if (!$result) {
            $url    = 'https://packagist.org/search.json?tags=owl-admin&per_page=15&q=' . $q;
            $result = file_get_contents($url);
        }

        return $this->response()->success(json_decode($result, true));
    }

    /**
     * 更多扩展
     *
     * @return DrawerAction
     */
    public function moreExtend()
    {
        return DrawerAction::make()
            ->label(__('admin.extensions.more_extensions'))
            ->icon('fa-regular fa-lightbulb')
            ->drawer(
                Drawer::make()
                    ->title(__('admin.extensions.more_extensions'))
                    ->size('xl')
                    ->closeOnEsc()
                    ->closeOnOutside()
                    ->body(
                        CRUDTable::make()
                            ->perPage(20)
                            ->affixHeader(false)
                            ->filterTogglable()
                            ->loadDataOnce()
                            ->filter(
                                $this->baseFilter()->body([
                                    TextControl::make()
                                        ->name('keywords')
                                        ->label('关键字')
                                        ->placeholder('输入关键字搜索')
                                        ->size('md'),
                                ])
                            )
                            ->filterDefaultVisible(false)
                            ->api('post:' . admin_url('dev_tools/extensions/more') . '?q=${keywords}')
                            ->perPage(15)
                            ->footerToolbar(['statistics', 'pagination'])
                            ->headerToolbar([
                                amis('reload')->align('right'),
                                amis('filter-toggler')->align('right'),
                            ])->columns([
                                TableColumn::make()->name('name')->label('名称')->width(200)
                                    ->type('tpl')
                                    ->tpl('<a href="${url}" target="_blank" title="打开 Packagist">${name}</a>'),
                                TableColumn::make()
                                    ->name('description')
                                    ->label('描述')
                                    ->type('tpl')
                                    ->tpl('${description|truncate: 50}')
                                    ->popOver(
                                        SchemaPopOver::make()->trigger('hover')->body(
                                            Tpl::make()->tpl('${description}')
                                        )->position('left-top')
                                    ),
                                TableColumn::make()->name('repository')->label('仓库')
                                    ->type('tpl')
                                    ->tpl('<a href="${repository}" target="_blank" title="打开代码仓库">${repository|truncate: 50}</a>'),
                                TableColumn::make()->name('downloads')->label('下载量')->width(100),
                                TableColumn::make()
                                    ->name('${"composer require " + name}')
                                    ->label('composer 安装命令')
                                    ->width(300)
                                    ->copyable(),
                            ])
                    )
                    ->actions([])
            );
    }

    /**
     * 安装
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function install(Request $request)
    {
        $file = $request->input('file');

        if (!$file) {
            return $this->response()->fail(__('admin.extensions.validation.file'));
        }

        try {
            $path = $this->getFilePath($file);

            $manager = Admin::extension();

            $extensionName = $manager->extract($path, true);

            if (!$extensionName) {
                return $this->response()->fail(__('admin.extensions.validation.invalid_package'));
            }

            return $this->response()->successMessage(
                __('admin.successfully_message', ['attribute' => __('admin.extensions.install')])
            );
        } catch (\Throwable $e) {
            return $this->response()->fail($e->getMessage());
        } finally {
            if (!empty($path)) {
                @unlink($path);
            }
        }
    }

    /**
     * @throws \Exception
     */
    protected function getFilePath($file)
    {
        $disk = config('admin.upload.disk') ?: 'local';

        $root = config("filesystems.disks.{$disk}.root");

        if (!$root) {
            throw new \Exception(sprintf('Missing \'root\' for disk [%s].', $disk));
        }

        return rtrim($root, '/') . '/' . $file;
    }

    /**
     * 启用/禁用
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function enable(Request $request)
    {
        Admin::extension()->enable($request->id, !$request->enabled);

        return $this->response()->successMessage(__('admin.action_success'));
    }

    /**
     * 卸载
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function uninstall(Request $request)
    {
        Admin::extension($request->id)->uninstall();

        return $this->response()->successMessage(__('admin.action_success'));
    }

    /**
     * 保存扩展设置
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function saveConfig(Request $request)
    {
        $data = collect($request->all())->except(['extension'])->toArray();

        Admin::extension($request->input('extension'))->saveConfig($data);

        return $this->response()->successMessage(__('admin.save_success'));
    }

    /**
     * 获取扩展设置
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getConfig(Request $request)
    {
        $config = Admin::extension($request->input('extension'))->config();

        return $this->response()->success($config);
    }

    /**
     * 获取扩展设置表单
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Resources\Json\JsonResource
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function configForm(Request $request)
    {
        $form = Admin::extension($request->id)->settingForm();

        return $this->response()->success($form);
    }
}
