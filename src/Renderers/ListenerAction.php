<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * ListenerAction
 *
 * @author  slowlyo
 * @version 6.6.0
 */
class ListenerAction extends BaseRenderer
{
    public function __construct()
    {


    }

    /**
     *
     */
    public function actionType($value = '')
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
     *
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
     *
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
