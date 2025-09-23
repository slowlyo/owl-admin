<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * ListenerAction
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class ListenerAction extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'action');
    }

    /**
     * 指定为发送 ajax 的行为。 可选值: prev | next | cancel | close | submit | confirm | add | reset | reset-and-submit
     */
    public function actionType($value = 'ajax')
    {
        return $this->set('actionType', $value);
    }

    /**
     * 
     */
    public function args($value = '')
    {
        return $this->set('args', $value);
    }

    /**
     * 
     */
    public function componentId($value = '')
    {
        return $this->set('componentId', $value);
    }

    /**
     * 
     */
    public function componentName($value = '')
    {
        return $this->set('componentName', $value);
    }

    /**
     * 确认弹窗标题
     */
    public function confirmTitle($value = '')
    {
        return $this->set('confirmTitle', $value);
    }

    /**
     * 页面级别的初始数据 (初始数据，设置得值可用于组件内部模板使用。)
     */
    public function data($value = '')
    {
        return $this->set('data', $value);
    }

    /**
     *  可选值: merge | override
     */
    public function dataMergeMode($value = '')
    {
        return $this->set('dataMergeMode', $value);
    }

    /**
     * 描述内容，支持 Html 片段。
     */
    public function description($value = '')
    {
        return $this->set('description', $value);
    }

    /**
     * 
     */
    public function execOn($value = '')
    {
        return $this->set('execOn', $value);
    }

    /**
     * 
     */
    public function expression($value = '')
    {
        return $this->set('expression', $value);
    }

    /**
     * 
     */
    public function ignoreError($value = true)
    {
        return $this->set('ignoreError', $value);
    }

    /**
     * 
     */
    public function outputVar($value = '')
    {
        return $this->set('outputVar', $value);
    }

    /**
     * 
     */
    public function preventDefault($value = true)
    {
        return $this->set('preventDefault', $value);
    }

    /**
     * 
     */
    public function stopPropagation($value = true)
    {
        return $this->set('stopPropagation', $value);
    }


}
