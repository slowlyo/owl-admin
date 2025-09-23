<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * NavOverflow
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class NavOverflow extends BaseRenderer
{

    /**
     * 是否开启响应式收纳
     */
    public function enable($value = true)
    {
        return $this->set('enable', $value);
    }

    /**
     * 导航项目宽度
     */
    public function itemWidth($value = '')
    {
        return $this->set('itemWidth', $value);
    }

    /**
     * 导航横向布局时，开启开启响应式收纳后最大可显示数量，超出此数量的导航将被收纳到下拉菜单中
     */
    public function maxVisibleCount($value = '')
    {
        return $this->set('maxVisibleCount', $value);
    }

    /**
     * 导航超出后响应式收纳方案。 可选值: popup | swipe
     */
    public function mode($value = '')
    {
        return $this->set('mode', $value);
    }

    /**
     * 菜单触发按钮CSS类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function overflowClassName($value = '')
    {
        return $this->set('overflowClassName', $value);
    }

    /**
     * 菜单触发按钮的图标 (iconfont 里面的类名。)
     */
    public function overflowIndicator($value = '')
    {
        return $this->set('overflowIndicator', $value);
    }

    /**
     * 菜单触发按钮的文字
     */
    public function overflowLabel($value = '')
    {
        return $this->set('overflowLabel', $value);
    }

    /**
     * 菜单外层CSS类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function overflowListClassName($value = '')
    {
        return $this->set('overflowListClassName', $value);
    }

    /**
     * Popover浮层CSS类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function overflowPopoverClassName($value = '')
    {
        return $this->set('overflowPopoverClassName', $value);
    }

    /**
     * 导航列表后缀节点 (导航列表后缀节点)
     */
    public function overflowSuffix($value = '')
    {
        return $this->set('overflowSuffix', $value);
    }

    /**
     * 自定义样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 包裹导航的外层标签名，可以使用其他标签渲染
     */
    public function wrapperComponent($value = '')
    {
        return $this->set('wrapperComponent', $value);
    }


}
