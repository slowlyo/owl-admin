<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * <b>Log 实时日志</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/log
 *
 * @method self height($value) 展示区域高度
 * @method self className($value) 外层 CSS 类名
 * @method self autoScroll($value) 是否自动滚动
 * @method self placeholder($value) 加载中的文字
 * @method self encoding($value) 返回内容的字符编码
 * @method self source($value) 接口
 * @method self rowHeight($value) 设置每行高度，将会开启虚拟渲染
 * @method self maxLength($value) 最大显示行数
 * @method self disableColor($value) 关闭 ANSI 颜色支持
 * @method self operation($value) 可选日志操作：['stop', 'clear', 'showLineNumber', 'filter']
 */
class Log extends BaseRenderer
{
    public string $type = 'log';
}
