<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * 图片展示控件。 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/image
 *
 * @method self onEvent($value) 事件动作配置
 * @method self static($value) 是否静态展示
 * @method self disabled($value) 是否禁用
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self visible($value) 是否显示
 * @method self defaultImage($value) 默认图片地址
 * @method self title($value) 图片标题
 * @method self innerClassName($value) 组件内层 css 类名
 * @method self thumbClassName($value) 图片缩略图外层 css 类名
 * @method self caption($value) 图片说明文字
 * @method self imageMode($value) 图片展示模式，默认为缩略图模式、可以配置成原图模式 可选值: thumb | original | 
 * @method self imageCaption($value) 图片描述信息
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定为图片展示类型 可选值: image | static-image | 
 * @method self enlargeAble($value) 是否启动放大功能。
 * @method self alt($value) 图片无法显示时的替换文本
 * @method self thumbRatio($value) 预览图比率 可选值: 1:1 | 4:3 | 16:9 | 
 * @method self href($value) 链接地址
 * @method self className($value) 外层 css 类名
 * @method self originalSrc($value) 大图地址，不设置用 src
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self staticSchema($value) 
 * @method self name($value) 关联字段名，也可以直接配置 src
 * @method self src($value) 图片地址，如果配置了 name，这个属性不用配置。
 * @method self width($value) 宽度
 * @method self toolbarActions($value) 工具栏配置
 * @method self visibleOn($value) 是否显示表达式
 * @method self height($value) 高度
 * @method self imageClassName($value) 图片 css 类名
 * @method self thumbMode($value) 预览图模式 可选值: w-full | h-full | contain | cover | 
 * @method self htmlTarget($value) 链接的 target
 * @method self showToolbar($value) 是否展示图片工具栏
 * @method self blank($value) 是否新窗口打开
 */
class Image extends BaseRenderer
{
    public string $type = 'image';
}
