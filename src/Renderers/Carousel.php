<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Carousel 轮播图渲染器。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/carousel
 *
 * @method self staticOn($value) 是否静态展示表达式
 * @method self controls($value) 配置控件内容
 * @method self disabled($value) 是否禁用
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self onEvent($value) 事件动作配置
 * @method self controlsTheme($value)  可选值: light | dark | 
 * @method self animation($value) 动画类型 可选值: fade | slide | 
 * @method self options($value) 配置固定值
 * @method self visibleOn($value) 是否显示表达式
 * @method self thumbMode($value) 预览图模式 可选值: contain | cover | 
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticSchema($value) 
 * @method self auto($value) 是否自动播放
 * @method self interval($value) 轮播间隔时间
 * @method self height($value) 设置高度
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self width($value) 设置宽度
 * @method self itemSchema($value) 配置单条呈现模板
 * @method self visible($value) 是否显示
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定为轮播图类型
 * @method self name($value) 
 * @method self className($value) 容器 css 类名
 * @method self static($value) 是否静态展示
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self duration($value) 动画时长
 * @method self hidden($value) 是否隐藏
 * @method self placeholder($value) 占位
 */
class Carousel extends BaseRenderer
{
    public string $type = 'carousel';
}
