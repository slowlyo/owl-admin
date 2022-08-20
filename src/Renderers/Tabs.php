<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Tabs 选项卡</b><br/>
 * 选项卡容器组件。
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/tabs
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self tabsMode($value) 展示模式，取值可以是 line、card、radio、vertical、chrome、simple、strong、tiled、sidebar
 * @method self tabsClassName($value) Tabs Dom 的类名
 * @method self tabs($value) tabs 内容
 * @method self source($value) tabs 关联数据，关联后可以重复生成选项卡
 * @method self toolbar($value) tabs 中的工具栏
 * @method self toolbarClassName($value) tabs 中工具栏的类名
 * @method self mountOnEnter($value) 只有在点中 tab 的时候才渲染
 * @method self unmountOnExit($value) 切换 tab 的时候销毁
 * @method self addable($value) 是否支持新增
 * @method self addBtnText($value) 增加    新增按钮文案
 * @method self closable($value) 是否支持删除
 * @method self draggable($value) 是否支持拖拽
 * @method self showTip($value) 是否支持提示
 * @method self showTipClassName($value) 提示的类
 * @method self editable($value) 收否可编辑标签名
 * @method self scrollable($value) 是否导航支持内容溢出滚动。（属性废弃）
 * @method self sidePosition($value) sidebar 模式下，标签栏位置
 */
class Tabs extends BaseRenderer
{
    public string $type = 'tabs';
}
