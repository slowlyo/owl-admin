<?php

namespace Slowlyo\OwlAdmin\Controllers;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Http\Request;
use Slowlyo\OwlAdmin\OwlAdmin;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Slowlyo\OwlAdmin\Traits\Export;
use Slowlyo\OwlAdmin\Traits\Uploader;
use Slowlyo\OwlAdmin\Traits\QueryPath;
use Slowlyo\OwlAdmin\Traits\PageElement;
use Slowlyo\OwlAdmin\Services\AdminService;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class AdminController extends Controller
{
    use QueryPath;
    use PageElement;
    use Uploader;
    use Export;

    protected AdminService $service;

    /** @var string $queryPath 路径 */
    protected string $queryPath;

    /** @var string|mixed $adminPrefix 路由前缀 */
    protected string $adminPrefix;

    /** @var bool $isCreate 是否是新增页面, 页面模式时生效 */
    protected bool $isCreate = false;

    /** @var bool $isEdit 是否是编辑页面, 页面模式时生效 */
    protected bool $isEdit = false;

    public function __construct()
    {
        if (property_exists($this, 'serviceName')) {
            $this->service = $this->serviceName::make();
        }

        $this->adminPrefix = Admin::config('admin.route.prefix');

        $this->queryPath = str_replace($this->adminPrefix . '/', '', request()->path());
    }

    /**
     * 获取当前登录用户
     *
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|\Slowlyo\OwlAdmin\Models\AdminUser|null
     */
    public function user()
    {
        return OwlAdmin::user();
    }

    /**
     * 是否为列表数据请求
     *
     * @return bool
     */
    public function actionOfGetData()
    {
        return request()->_action == 'getData';
    }

    /**
     * 是否为导出数据请求
     *
     * @return bool
     */
    public function actionOfExport()
    {
        return request()->_action == 'export';
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function getPrimaryValue($request): mixed
    {
        $primaryKey = $this->service->primaryKey();

        return $request->$primaryKey;
    }

    /**
     * 后台响应
     *
     * @return \Slowlyo\OwlAdmin\Support\JsonResponse
     */
    protected function response()
    {
        return OwlAdmin::response();
    }

    protected function autoResponse($flag, $text = '')
    {
        if (!$text) {
            $text = __('admin.actions');
        }

        if ($flag) {
            return $this->response()->successMessage($text . __('admin.successfully'));
        }

        return $this->response()->fail($this->service->getError() ?? $text . __('admin.failed'));
    }

    public function index()
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->list());
        }

        if ($this->actionOfExport()) {
            return $this->export();
        }

        return $this->response()->success($this->list());
    }

    /**
     * 获取新增页面
     *
     * @return JsonResponse|JsonResource
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create()
    {
        $this->isCreate = true;

        $form = amisMake()
            ->Card()
            ->className('base-form')
            ->header(['title' => __('admin.create')])
            ->toolbar([$this->backButton()])
            ->body($this->form(false)->api($this->getStorePath()));

        $page = $this->basePage()->body($form);

        return $this->response()->success($page);
    }

    /**
     * 新增保存
     *
     * @param Request $request
     *
     * @return JsonResponse|JsonResource
     */
    public function store(Request $request)
    {
        return $this->autoResponse($this->service->store($request->all()), __('admin.save'));
    }

    /**
     * 详情
     *
     * @param $id
     *
     * @return JsonResponse|JsonResource
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function show($id)
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->getDetail($id));
        }

        $detail = amisMake()
            ->Card()
            ->className('base-form')
            ->header(['title' => __('admin.detail')])
            ->body($this->detail())
            ->toolbar([$this->backButton()]);

        $page = $this->basePage()->body($detail);

        return $this->response()->success($page);
    }

    /**
     * 获取编辑页面
     *
     * @param $id
     *
     * @return JsonResponse|JsonResource
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function edit($id)
    {
        $this->isEdit = true;

        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->getEditData($id));
        }

        $form = amisMake()
            ->Card()
            ->className('base-form')
            ->header(['title' => __('admin.edit')])
            ->toolbar([$this->backButton()])
            ->body(
                $this->form(true)->api($this->getUpdatePath())->initApi($this->getEditGetDataPath())
            );

        $page = $this->basePage()->body($form);

        return $this->response()->success($page);
    }

    /**
     * 编辑保存
     *
     * @param Request $request
     *
     * @return JsonResponse|JsonResource
     */
    public function update(Request $request)
    {
        $result = $this->service->update($this->getPrimaryValue($request), $request->all());

        return $this->autoResponse($result, __('admin.save'));
    }

    /**
     * 删除
     *
     * @param $ids
     *
     * @return JsonResponse|JsonResource
     */
    public function destroy($ids)
    {
        $rows = $this->service->delete($ids);

        return $this->autoResponse($rows, __('admin.delete'));
    }
}
