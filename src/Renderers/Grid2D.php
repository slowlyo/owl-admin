<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 二维布局渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/grid-2d
 *
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self gapRow($value) 格子行级别的间距，如果不设置就和 gap 一样
 * @method self rowHeight($value) 单位行高度，默认 50 px
 * @method self className($value) 容器 css 类名
 * @method self hidden($value) 是否隐藏
 * @method self visibleOn($value) 是否显示表达式
 * @method self static($value) 是否静态展示
 * @method self gap($value) 格子间距，默认 0，包含行和列
 * @method self disabled($value) 是否禁用
 * @method self disabledOn($value) 是否禁用表达式
 * @method self onEvent($value) 事件动作配置
 * @method self staticSchema($value) 
 * @method self width($value) grid 2d 容器宽度，默认是 auto
 * @method self grids($value) 每个格子的配置
 * @method self visible($value) 是否显示
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self type($value) 指定为 grid-2d 展示类型
 * @method self cols($value) 列数量，默认是 12
 */
class Grid2D extends BaseRenderer
{
    public string $type = 'grid-2d';
}
