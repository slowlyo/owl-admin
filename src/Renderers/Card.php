<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Card 卡片</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/card
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self href($value) 外部链接
 * @method self header($value) 头部内容设置
 * @method self body($value) 内容容器，主要用来放置非表单项组件
 * @method self bodyClassName($value) 内容区域类名
 * @method self actions($value) 配置按钮集合
 * @method self actionsCount($value) 按钮集合每行个数
 * @method self itemAction($value) 点击卡片的行为
 * @method self media($value) 多媒体部内容设置
 * @method self secondary($value) 次要说明
 * @method self toolbar($value) 工具栏按钮
 * @method self dragging($value) 是否显示拖拽图标
 * @method self selectable($value) 卡片是否可选
 * @method self checkable($value) 卡片选择按钮是否禁用
 * @method self selected($value) 卡片选择按钮是否选中
 * @method self hideCheckToggler($value) 卡片选择按钮是否隐藏
 * @method self multiple($value) 卡片是否为多选
 * @method self useCardLabel($value) 卡片内容区的表单项 label 是否使用 Card 内部的样式
 */
class Card extends BaseRenderer
{
    public string $type = 'card';
}
