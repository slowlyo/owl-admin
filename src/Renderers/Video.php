<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 视频播放器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/video
 *
 * @method self style($value) 
 * @method self disabledOn($value) 是否禁用表达式
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticSchema($value) 
 * @method self framesClassName($value) 配置帧列表容器className
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self splitPoster($value) 是否将视频和封面分开显示
 * @method self onEvent($value) 事件动作配置
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定为视频类型
 * @method self isLive($value) 如果是实时的，请标记一下
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self autoPlay($value) 是否自动播放
 * @method self columnsCount($value) 如果显示切帧，通过此配置项可以控制每行显示多少帧
 * @method self visible($value) 是否显示
 * @method self frames($value) 设置后，可以显示切帧.点击帧的时候会将视频跳到对应时间。frames: {  '01:22': 'http://domain/xxx.jpg' }
 * @method self jumpFrame($value) 点击帧画面时是否跳转视频对应的点
 * @method self rates($value) 视频速率
 * @method self aspectRatio($value) 视频比率 可选值: auto | 4:3 | 16:9 | 
 * @method self stopOnNextFrame($value) 默认播放的时候到了下一帧会继续播放，同时高亮下一帧。 如果配置这个则会停止播放，等待用户选择新的区间再播放。
 * @method self className($value) 容器 css 类名
 * @method self hidden($value) 是否隐藏
 * @method self poster($value) 视频封面地址
 * @method self src($value) 视频播放地址
 * @method self videoType($value) 视频类型如： video/x-flv
 * @method self disabled($value) 是否禁用
 * @method self static($value) 是否静态展示
 * @method self muted($value) 是否初始静音
 * @method self playerClassName($value) 配置播放器 className
 * @method self jumpBufferDuration($value) 跳转到帧时，往前多少秒。
 */
class Video extends BaseRenderer
{
    public string $type = 'video';
}
