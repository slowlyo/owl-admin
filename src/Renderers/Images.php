<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 图片集展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/images
 *
 * @method self enlargeAble($value) 是否启动放大功能。
 * @method self toolbarActions($value) 工具栏配置
 * @method self disabled($value) 是否禁用
 * @method self visibleOn($value) 是否显示表达式
 * @method self onEvent($value) 事件动作配置
 * @method self static($value) 是否静态展示
 * @method self options($value) 
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self placeholder($value) 列表为空时显示
 * @method self thumbMode($value) 预览图模式 可选值: w-full | h-full | contain | cover | 
 * @method self name($value) 关联字段名，也可以直接配置 src
 * @method self originalSrc($value) 大图地址，不设置用 src 属性，如果不是请配置，如：${imageOriginUrl}
 * @method self showToolbar($value) 是否展示图片工具栏
 * @method self value($value) 
 * @method self source($value) 
 * @method self src($value) 图片地址，默认读取数据中的 image 属性，如果不是请配置 ,如  ${imageUrl}
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self delimiter($value) 配置值的连接符
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self thumbRatio($value) 预览图比率 可选值: 1:1 | 4:3 | 16:9 | 
 * @method self className($value) 外层 CSS 类名
 * @method self staticSchema($value) 
 * @method self listClassName($value) 列表 CSS 类名
 * @method self defaultImage($value) 默认图片地址
 * @method self hidden($value) 是否隐藏
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self visible($value) 是否显示
 * @method self type($value) 指定为图片集渲染器 可选值: images | static-images | 
 * @method self staticOn($value) 是否静态展示表达式
 * @method self showDimensions($value) 是否显示尺寸。
 */
class Images extends BaseRenderer
{
    public string $type = 'images';
}
