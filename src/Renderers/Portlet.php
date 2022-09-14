<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Portlet 门户栏目</b><br/>
 * 门户栏目组件。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/portlet
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self tabsClassName($value) Tabs Dom 的类名
 * @method self contentClassName($value) Tabs content Dom 的类名
 * @method self tabs($value) tabs 内容
 * @method self source($value) tabs 关联数据，关联后可以重复生成选项卡
 * @method self toolbar($value)    tabs 中的工具栏，不随 tab 切换而变化
 * @method self style($value) 自定义样式
 * @method self description($value) 标题右侧信息
 * @method self hideHeader($value) 隐藏头部
 * @method self divider($value) 去掉分隔线
 * @method self mountOnEnter($value) 只有在点中 tab 的时候才渲染
 * @method self unmountOnExit($value) 切换 tab 的时候销毁
 * @method self scrollable($value) 是否导航支持内容溢出滚动，vertical和chrome模式下不支持该属性；chrome模式默认压缩标签
 */
class Portlet extends BaseRenderer
{
    public string $type = 'portlet';
}
