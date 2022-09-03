<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Dialog 对话框</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/dialog
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self title($value) 弹出层标题
 * @method self body($value) 往 Dialog 内容区加内容
 * @method self size($value) 指定 dialog 大小，支持: xs、sm、md、lg、xl、full
 * @method self bodyClassName($value) Dialog body 区域的样式类名
 * @method self closeOnEsc($value = true) 是否支持按 Esc 关闭 Dialog
 * @method self showCloseButton($value = true) 是否显示右上角的关闭按钮
 * @method self showErrorMsg($value = true) 是否在弹框左下角显示报错信息
 * @method self showLoading($value = true) 是否在弹框左下角显示 loading 动画
 * @method self disabled($value = true) 如果设置此属性，则该 Dialog 只读没有提交操作。
 * @method self actions($value) 【确认】和【取消】    如果想不显示底部按钮，可以配置：[]
 * @method self data($value) 支持数据映射，如果不设定将默认将触发按钮的上下文中继承数据
 */
class Dialog extends BaseRenderer
{
    public string $type = 'dialog';
}
