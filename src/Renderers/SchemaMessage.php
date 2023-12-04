<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 消息文案配置，记住这个优先级是最低的，如果你的接口返回了 msg，接口返回的优先。
 *
 * @author  slowlyo
 * @version v3.6.1
 */
class SchemaMessage extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     * 获取失败时的提示
     */
    public function fetchFailed($value = '')
    {
        return $this->set('fetchFailed', $value);
    }

    /**
     * 获取成功的提示，默认为空。
     */
    public function fetchSuccess($value = '')
    {
        return $this->set('fetchSuccess', $value);
    }

    /**
     * 保存失败时的提示。
     */
    public function saveFailed($value = '')
    {
        return $this->set('saveFailed', $value);
    }

    /**
     * 保存成功时的提示。
     */
    public function saveSuccess($value = '')
    {
        return $this->set('saveSuccess', $value);
    }


}
