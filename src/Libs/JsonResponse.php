<?php

namespace Slowlyo\SlowAdmin\Libs;

use Slowlyo\SlowAdmin\Renderers\BaseRenderer;
use Illuminate\Http\Resources\Json\JsonResource;

class JsonResponse
{
    /** @var array 额外参数 */
    private array $additionalData = [
        'status'            => 0,
        'msg'               => '',
        'doNotDisplayToast' => 0,
    ];

    /**
     * @param string $message
     * @param null $data
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function fail(string $message = 'Service error', $data = null): \Illuminate\Http\JsonResponse
    {
        $this->setFailMsg($message);

        return response()->json(array_merge($this->additionalData, ['data' => $data]));
    }

    /**
     * @param null $data
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse|JsonResource
     */
    public function success($data = null, string $message = ''): \Illuminate\Http\JsonResponse|JsonResource
    {
        $this->setSuccessMsg($message);

        if ($data instanceof JsonResource) {
            return $data->additional($this->additionalData)->response();
        }

        if ($data === null) {
            $data = (object)$data;
        }

        if ($data instanceof BaseRenderer) {
            $data = $data->toArray();
        }

        return response()->json(array_merge($this->additionalData, ['data' => $data]));
    }

    /**
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse|JsonResource
     */
    public function successMessage(string $message = ''): \Illuminate\Http\JsonResponse|JsonResource
    {
        return $this->success([], $message);
    }

    private function setSuccessMsg($message)
    {
        $this->additionalData['msg'] = $message;
    }

    private function setFailMsg($message)
    {
        $this->additionalData['msg']    = $message;
        $this->additionalData['status'] = 1;
    }

    /**
     * 配置弹框时间 (ms)
     *
     * @param $timeout
     *
     * @return $this
     */
    public function setMsgTimeout($timeout): static
    {
        return $this->additional(['msgTimeout' => $timeout]);
    }

    /**
     * 添加额外参数
     *
     * @param array $params
     *
     * @return $this
     */
    public function additional(array $params = []): static
    {
        $this->additionalData = array_merge($this->additionalData, $params);

        return $this;
    }

    /**
     * 不显示弹框
     *
     * @return $this
     */
    public function doNotDisplayToast()
    {
        $this->additionalData['doNotDisplayToast'] = 1;

        return $this;
    }
}
