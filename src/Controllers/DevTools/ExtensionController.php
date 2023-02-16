<?php

namespace Slowlyo\SlowAdmin\Controllers\DevTools;

use Illuminate\Http\Request;
use Slowlyo\SlowAdmin\Admin;
use Slowlyo\SlowAdmin\Renderers\Tpl;
use Slowlyo\SlowAdmin\Renderers\Form;
use Slowlyo\SlowAdmin\Renderers\Card;
use Slowlyo\SlowAdmin\Renderers\Alert;
use Slowlyo\SlowAdmin\Renderers\Dialog;
use Slowlyo\SlowAdmin\Extend\Extension;
use Slowlyo\SlowAdmin\Renderers\Drawer;
use Slowlyo\SlowAdmin\Renderers\Wrapper;
use Slowlyo\SlowAdmin\Renderers\Divider;
use Slowlyo\SlowAdmin\Renderers\Service;
use Slowlyo\SlowAdmin\Renderers\Markdown;
use Slowlyo\SlowAdmin\Renderers\CRUDCards;
use Slowlyo\SlowAdmin\Renderers\CRUDTable;
use Slowlyo\SlowAdmin\Renderers\UrlAction;
use Slowlyo\SlowAdmin\Renderers\AjaxAction;
use Slowlyo\SlowAdmin\Renderers\TextControl;
use Slowlyo\SlowAdmin\Renderers\FileControl;
use Slowlyo\SlowAdmin\Renderers\TableColumn;
use Slowlyo\SlowAdmin\Renderers\DialogAction;
use Slowlyo\SlowAdmin\Renderers\DrawerAction;
use Slowlyo\SlowAdmin\Renderers\SchemaPopOver;
use Slowlyo\SlowAdmin\Controllers\AdminController;

class ExtensionController extends AdminController
{
    protected string $queryPath = 'dev_tools/extensions';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = __('admin.extensions.page_title');
    }

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
            ->filterTogglable(true)
            ->filterDefaultVisible(false)
            ->api($this->getListGetDataPath())
            ->perPageAvailable([10, 20, 30, 50, 100, 200])
            ->footerToolbar(['switch-per-page', 'statistics', 'pagination'])
            ->loadDataOnce(true)
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
                UrlAction::make()
                    ->icon('fa-regular fa-lightbulb')
                    ->label(__('admin.extensions.more_extensions'))
                    ->link('https://slowlyo.gitee.io/slow-admin-doc/extensions/')
                    ->blank(true),
                amis('reload')->align('right'),
                amis('filter-toggler')->align('right'),
            ])->card(
                Card::make()->header([
                    'title'           => '${alias || "-" | truncate: 8}',
                    'subTitle'        => '${name}',
                    'avatar'          => '${logo || "https://slowlyo.gitee.io/slow-admin-doc/static/logo.png"}',
                    'avatarClassName' => 'pull-left thumb-md avatar m-r',
                ])->body([
                    amis()->label(__('admin.extensions.card.author'))
                        ->type('tpl')
                        ->tpl('${authors[0].name} < <span class="text-info">${authors[0].email}</span> >'),
                    amis()->label(__('admin.extensions.card.version'))->name('version'),
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
                                ->closeOnOutside(true)
                                ->closeOnEsc(true)
                                ->body(Markdown::make()->name('${doc | raw}')->options(['html' => true, 'breaks' => true]))
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
                            ->showIcon(true)
                            ->body(__('admin.extensions.create_tips', ['dir' => config('admin.extension.dir')])),
                        TextControl::make()
                            ->name('name')
                            ->label(__('admin.extensions.form.name'))
                            ->placeholder('eg: slowlyo/slow-admin')
                            ->required(true),
                        TextControl::make()
                            ->name('namespace')
                            ->label(__('admin.extensions.form.namespace'))
                            ->placeholder('eg: Slowlyo\Notice')
                            ->required(true),
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
                        FileControl::make()->name('file')->label('')->required(true)->drag(true)->accept('.zip'),
                    ])
                )
            );
    }

    /**
     * 更多扩展
     * gitee 和 github 的 pages 都不能跨域访问, 放弃这个方案
     *
     * @return DrawerAction
     * @deprecated
     */
    public function moreExtend()
    {
        return DrawerAction::make()->label('更多扩展')->icon('fa-regular fa-lightbulb')->drawer(
            Drawer::make()->title('更多扩展')->size('xl')->closeOnEsc(true)->closeOnOutside(true)->body(
                CRUDTable::make()
                    ->perPage(20)
                    ->affixHeader(false)
                    ->filterTogglable(true)
                    ->loadDataOnce(true)
                    ->source('${rows | filter:name,author,description:match:keywords}')
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
                    ->api(url('/extend-data.json'))
                    ->perPageAvailable([10, 20, 30, 50, 100, 200])
                    ->footerToolbar(['switch-per-page', 'statistics', 'pagination'])
                    ->headerToolbar([
                        amis('reload')->align('right'),
                        amis('filter-toggler')->align('right'),
                    ])->columns([
                        TableColumn::make()->name('name')->label('名称')->width(200)
                            ->type('tpl')
                            ->tpl('<a href="${repository}" target="_blank" title="打开代码仓库">${name}</a>'),
                        TableColumn::make()
                            ->name('author')
                            ->label('作者')
                            ->width(200)
                            ->type('tpl')
                            ->tpl('<a href="${author_homepage}" target="_blank" title="打开作者主页">${author}</a>'),
                        TableColumn::make()
                            ->name('description')
                            ->label('描述')
                            ->type('tpl')
                            ->tpl('${description|truncate: 30}')
                            ->popOver(
                                SchemaPopOver::make()->trigger('hover')->body(
                                    Tpl::make()->tpl('${description}')
                                )->position('left-top')
                            ),
                        TableColumn::make()
                            ->name('zip_download_address')
                            ->label('zip下载地址')
                            ->width(300)
                            ->remark('下载后请使用 [本地安装] 功能自行安装')
                            ->type('tpl')
                            ->tpl('<a href="${zip_download_address}" target="_blank" title="去下载">${zip_download_address | truncate: 40}</a>'),
                        TableColumn::make()
                            ->name('composer_command')
                            ->label('composer 安装命令')
                            ->width(300)
                            ->copyable(true),
                    ])
            )->actions([])
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
