<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Progress 进度条</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/progress
 *
 * @method self mode($value) 进度「条」的类型，可选line circle dashboard
 * @method self className($value) 外层 CSS 类名
 * @method self value($value) 进度值
 * @method self placeholder($value) 占位文本
 * @method self showLabel($value = true) 是否展示进度文本
 * @method self stripe($value = true) 背景是否显示条纹
 * @method self animate($value) type 为 line，可支持动画
 * @method self map($value) 进度颜色映射
 * @method self valueTpl($value) 自定义格式化内容
 * @method self strokeWidth($value) 进度条线宽度
 * @method self gapDegree($value) 仪表盘缺角角度，可取值 0 ~ 295
 * @method self gapPosition($value) 仪表盘进度条缺口位置，可选top bottom left right
 */
class Progress extends BaseRenderer
{
    public string $type = 'progress';
}
