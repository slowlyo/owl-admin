<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Steps 步骤条</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/steps
 *
 * @method self steps($value) 数组，配置步骤信息
 * @method self source($value) 选项组源，可通过数据映射获取当前数据域变量、或者配置 API 对象
 * @method self name($value) 关联上下文变量
 * @method self value($value) 设置默认值，注意不支持表达式
 * @method self status($value) 状态
 * @method self className($value) 自定义类名
 * @method self mode($value) 指定步骤条方向。目前支持水平（horizontal）和竖直（vertical）两种方向
 * @method self labelPlacement($value) 指定标签放置位置，默认水平放图标右侧，可选 (vertical) 放图标下方
 * @method self progressDot($value) 点状步骤条
 */
class Steps extends BaseRenderer
{
    public string $type = 'steps';
}
