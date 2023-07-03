<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Pagination
 * 
 * @author slowlyo
 * @version v3.2.0
 */
class Pagination extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'pagination');

    }

    /**
     * 当前页数
     */
    public function activePage($value = '')
    {
        return $this->set('activePage', $value);
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    public function hasNext($value = true)
    {
        return $this->set('hasNext', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 通过控制layout属性的顺序，调整分页结构 total,perPage,pager,go
     */
    public function layout($value = '')
    {
        return $this->set('layout', $value);
    }

    /**
     * 最多显示多少个分页按钮。
     */
    public function maxButtons($value = '')
    {
        return $this->set('maxButtons', $value);
    }

    /**
     * 模式，默认normal，如果只想简单显示可以配置成 `simple`。
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 每页显示条数
     */
    public function perPage($value = '')
    {
        return $this->set('perPage', $value);
    }

    /**
     * 指定每页可以显示多少条
     */
    public function perPageAvailable($value = true)
    {
        return $this->set('perPageAvailable', $value);
    }

    /**
     * 弹层挂载节点
     */
    public function popOverContainerSelector($value = '')
    {
        return $this->set('popOverContainerSelector', $value);
    }

    /**
     * 是否显示快速跳转输入框
     */
    public function showPageInput($value = true)
    {
        return $this->set('showPageInput', $value);
    }

    /**
     * 是否展示分页切换，也同时受layout控制
     */
    public function showPerPage($value = true)
    {
        return $this->set('showPerPage', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 静态展示空值占位
     */
    public function staticPlaceholder($value = '')
    {
        return $this->set('staticPlaceholder', $value);
    }

    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 总条数
     */
    public function total($value = '')
    {
        return $this->set('total', $value);
    }

    public function type($value = 'pagination')
    {
        return $this->set('type', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }

}
