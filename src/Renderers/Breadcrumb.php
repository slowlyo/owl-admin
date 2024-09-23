<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Breadcrumb 面包屑 https://aisuda.bce.baidu.com/amis/zh-CN/components/breadcrumb
 *
 * @author  slowlyo
 * @version 6.8.0
 */
class Breadcrumb extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'breadcrumb');
    }

    /**
     * 外层类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 下拉菜单类名
     */
    public function dropdownClassName($value = '')
    {
        return $this->set('dropdownClassName', $value);
    }

    /**
     * 下拉菜单项类名
     */
    public function dropdownItemClassName($value = '')
    {
        return $this->set('dropdownItemClassName', $value);
    }

    /**
     * 导航项类名
     */
    public function itemClassName($value = '')
    {
        return $this->set('itemClassName', $value);
    }

    /**
     * 文本
     */
    public function items($value = '')
    {
        return $this->set('items', $value);
    }

    /**
     * 最大展示长度
     */
    public function labelMaxLength($value = '')
    {
        return $this->set('labelMaxLength', $value);
    }

    /**
     * 分隔符
     */
    public function separator($value = '')
    {
        return $this->set('separator', $value);
    }

    /**
     * 分割符类名
     */
    public function separatorClassName($value = '')
    {
        return $this->set('separatorClassName', $value);
    }

    /**
     * 动态数据
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
    }

    /**
     * 浮窗提示位置
     */
    public function tooltipPosition($value = '')
    {
        return $this->set('tooltipPosition', $value);
    }

    /**
     * 指定为 breadcrumb 渲染器。
     */
    public function type($value = 'breadcrumb')
    {
        return $this->set('type', $value);
    }


}
