<?php

namespace Slowlyo\SlowAdmin\Controllers;

use Illuminate\Http\Request;
use Slowlyo\SlowAdmin\SlowAdmin;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Slowlyo\SlowAdmin\Traits\Uploader;
use Slowlyo\SlowAdmin\Traits\QueryPath;
use Slowlyo\SlowAdmin\Traits\PageElement;
use Slowlyo\SlowAdmin\Services\AdminService;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class AdminController extends Controller
{
    use QueryPath;
    use PageElement;
    use Uploader;

    protected AdminService $service;

    /** @var string $queryPath 路径 */
    protected string $queryPath;

    /** @var string|\Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed $adminPrefix 路由前缀 */
    protected string $adminPrefix;

    /** @var string $pageTitle 页面标题 */
    protected string $pageTitle;

    public function __construct()
    {
        if (property_exists($this, 'serviceName')) {
            $this->service = $this->serviceName::make();
        }

        $this->adminPrefix = config('admin.route.prefix');
    }

    public function user()
    {
        return SlowAdmin::user();
    }

    public function actionOfGetData()
    {
        return request()->_action == 'getData';
    }

    /**
     * @param $request
     *
     * @return mixed
     */
    public function getPrimaryValue($request): mixed
    {
        return $request->id;
    }

    protected function response()
    {
        return SlowAdmin::response();
    }

    protected function autoResponse($flag, $text = '操作')
    {
        if ($flag) {
            return $this->response()->successMessage($text . '成功');
        }

        return $this->response()->fail($this->service->getError() ?? $text . '失败');
    }

    /**
     * 获取新增页面
     *
     * @return JsonResponse|JsonResource
     */
    public function create()
    {
        $form = $this->form()->api($this->getStorePath());

        $page = $this->basePage()->subTitle('新增')->body($form)->toolbar([$this->backButton()]);

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
        return $this->autoResponse($this->service->store($request->all()), '保存');
    }

    /**
     * 详情
     *
     * @param $id
     *
     * @return JsonResponse|JsonResource
     */
    public function show($id)
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->getDetail($id));
        }

        $page = $this->basePage()->subTitle('详情')->toolbar([$this->backButton()])->body($this->detail($id));

        return $this->response()->success($page);
    }

    /**
     * 获取编辑页面
     *
     * @param $id
     *
     * @return JsonResponse|JsonResource
     */
    public function edit($id)
    {
        if ($this->actionOfGetData()) {
            return $this->response()->success($this->service->getEditData($id));
        }

        $form = $this->form()
            ->api($this->getUpdatePath($id))
            ->initApi($this->getEditGetDataPath($id));

        $page = $this->basePage()->subTitle('编辑')->toolbar([$this->backButton()])->body($form);

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

        return $this->autoResponse($result, '保存');
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

        return $this->autoResponse($rows, '删除');
    }
}
