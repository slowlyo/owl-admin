<?php

namespace Slowlyo\OwlAdmin\Traits;

trait CheckActionTrait
{
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
     * 是否为快速编辑数据请求
     *
     * @return bool
     */
    public function actionOfQuickEdit()
    {
        return request()->_action == 'quickEdit';
    }

    /**
     * 是否为快速编辑数据请求
     *
     * @return bool
     */
    public function actionOfQuickEditItem()
    {
        return request()->_action == 'quickEditItem';
    }
}
