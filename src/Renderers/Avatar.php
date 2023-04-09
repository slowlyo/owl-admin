<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visible($value) 是否显示
 * @method self className($value) 类名
 * @method self visibleOn($value) 是否显示表达式
 * @method self static($value) 是否静态展示
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self staticSchema($value) 
 * @method self alt($value) 图片无法显示时的替换文字地址
 * @method self hidden($value) 是否隐藏
 * @method self staticOn($value) 是否静态展示表达式
 * @method self src($value) 图片地址
 * @method self icon($value) 图标
 * @method self text($value) 文本
 * @method self style($value) 自定义样式
 * @method self size($value) 大小
 * @method self onError($value) 图片加载失败的是否默认处理，字符串函数
 * @method self disabled($value) 是否禁用
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self shape($value) 形状 可选值: circle | square | rounded | 
 * @method self crossOrigin($value) 图片CORS属性 可选值: anonymous | use-credentials |  | 
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self type($value) 
 * @method self gap($value) 字符类型距离左右两侧边界单位像素
 * @method self draggable($value) 图片是否允许拖动
 * @method self onEvent($value) 事件动作配置
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self badge($value) 角标
 * @method self fit($value) 图片相对于容器的缩放方式 可选值: fill | contain | cover | none | scale-down | 
 */
class Avatar extends BaseRenderer
{
    public string $crossOrigin = 'anonymous';
    public string $type = 'avatar';
}
