<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Nav 导航渲染器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/nav
 *
 * @author  slowlyo
 * @version v3.5.0
 */
class Nav extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'nav');


    }

    /**
     * 手风琴展开 仅垂直inline模式支持
     */
    public function accordion($value = true)
    {
        return $this->set('accordion', $value);
    }

    /**
     * 角标
     */
    public function badge($value = '')
    {
        return $this->set('badge', $value);
    }

    /**
     * 容器 css 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 控制菜单缩起
     */
    public function collapsed($value = true)
    {
        return $this->set('collapsed', $value);
    }

    /**
     * 默认展开层级 小于等于该层数的节点默认全部打开
     */
    public function defaultOpenLevel($value = '')
    {
        return $this->set('defaultOpenLevel', $value);
    }

    /**
     * 懒加载 api，如果不配置复用 source 接口。
     */
    public function deferApi($value = '')
    {
        return $this->set('deferApi', $value);
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

    /**
     * 仅允许同层级拖拽
     */
    public function dragOnSameLevel($value = true)
    {
        return $this->set('dragOnSameLevel', $value);
    }

    /**
     * 可拖拽
     */
    public function draggable($value = true)
    {
        return $this->set('draggable', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 自定义展开图标
     */
    public function expandIcon($value = '')
    {
        return $this->set('expandIcon', $value);
    }

    /**
     * 自定义展开图标位置 默认在前面 before after
     */
    public function expandPosition($value = '')
    {
        return $this->set('expandPosition', $value);
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
     *
     */
    public function indentSize($value = '')
    {
        return $this->set('indentSize', $value);
    }

    /**
     * 更多操作菜单列表
     */
    public function itemActions($value = '')
    {
        return $this->set('itemActions', $value);
    }

    /**
     * 角标
     */
    public function itemBadge($value = '')
    {
        return $this->set('itemBadge', $value);
    }

    /**
     * 最多展示多少层级
     */
    public function level($value = '')
    {
        return $this->set('level', $value);
    }

    /**
     * 链接地址集合
     */
    public function links($value = '')
    {
        return $this->set('links', $value);
    }

    /**
     * 垂直模式 非折叠状态下 控制菜单打开方式 可选值: float | inline
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
     * 横向导航时自动收纳配置
     */
    public function overflow($value = '')
    {
        return $this->set('overflow', $value);
    }

    /**
     * 子菜单项展开浮层样式
     */
    public function popupClassName($value = '')
    {
        return $this->set('popupClassName', $value);
    }

    /**
     * 保存排序的 api
     */
    public function saveOrderApi($value = '')
    {
        return $this->set('saveOrderApi', $value);
    }

    /**
     * 搜索框相关配置
     */
    public function searchConfig($value = '')
    {
        return $this->set('searchConfig', $value);
    }

    /**
     * 是否开启搜索
     */
    public function searchable($value = true)
    {
        return $this->set('searchable', $value);
    }

    /**
     * 控制仅展示指定key菜单下的子菜单项
     */
    public function showKey($value = '')
    {
        return $this->set('showKey', $value);
    }

    /**
     * 可以通过 API 拉取。
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
    }

    /**
     * true 为垂直排列，false 为水平排列类似如 tabs。 可选值: 1 |
     */
    public function stacked($value = true)
    {
        return $this->set('stacked', $value);
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

    /**
     *
     */
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
     * 主题配色 默认light 可选值: light | dark
     */
    public function themeColor($value = '')
    {
        return $this->set('themeColor', $value);
    }

    /**
     * 指定为 Nav 导航渲染器
     */
    public function type($value = 'nav')
    {
        return $this->set('type', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
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
