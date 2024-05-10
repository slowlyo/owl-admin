<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 视频播放器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/video
 *
 * @author  slowlyo
 * @version 6.4.1
 */
class Video extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'video');
    }

    /**
     * 视频比率 可选值: auto | 4:3 | 16:9
     */
    public function aspectRatio($value = '')
    {
        return $this->set('aspectRatio', $value);
    }

    /**
     * 是否自动播放
     */
    public function autoPlay($value = true)
    {
        return $this->set('autoPlay', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 如果显示切帧，通过此配置项可以控制每行显示多少帧
     */
    public function columnsCount($value = '')
    {
        return $this->set('columnsCount', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 设置后，可以显示切帧.点击帧的时候会将视频跳到对应时间。frames: {  '01:22': 'http://domain/xxx.jpg' }
     */
    public function frames($value = '')
    {
        return $this->set('frames', $value);
    }

    /**
     * 配置帧列表容器className (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function framesClassName($value = '')
    {
        return $this->set('framesClassName', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 组件唯一 id，主要用于日志采集
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 如果是实时的，请标记一下
     */
    public function isLive($value = true)
    {
        return $this->set('isLive', $value);
    }

    /**
     * 跳转到帧时，往前多少秒。
     */
    public function jumpBufferDuration($value = '')
    {
        return $this->set('jumpBufferDuration', $value);
    }

    /**
     * 点击帧画面时是否跳转视频对应的点
     */
    public function jumpFrame($value = true)
    {
        return $this->set('jumpFrame', $value);
    }

    /**
     * 是否循环播放
     */
    public function loop($value = true)
    {
        return $this->set('loop', $value);
    }

    /**
     * 是否初始静音
     */
    public function muted($value = true)
    {
        return $this->set('muted', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 配置播放器 className (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function playerClassName($value = '')
    {
        return $this->set('playerClassName', $value);
    }

    /**
     * 视频封面地址 (视频封面地址)
     */
    public function poster($value = '')
    {
        return $this->set('poster', $value);
    }

    /**
     * 视频速率
     */
    public function rates($value = '')
    {
        return $this->set('rates', $value);
    }

    /**
     * 是否将视频和封面分开显示
     */
    public function splitPoster($value = true)
    {
        return $this->set('splitPoster', $value);
    }

    /**
     * 视频播放地址 (视频播放地址)
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
    }

    /**
     * 是否静态展示
     */
    public function static($value = true)
    {
        return $this->set('static', $value);
    }

    /**
     * 静态展示表单项类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 静态展示表单项Value类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 静态展示表单项Label类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 是否静态展示表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 静态展示空值占位
     */
    public function staticPlaceholder($value = '')
    {
        return $this->set('staticPlaceholder', $value);
    }

    /**
     *
     */
    public function staticSchema($value = '')
    {
        return $this->set('staticSchema', $value);
    }

    /**
     * 默认播放的时候到了下一帧会继续播放，同时高亮下一帧。 如果配置这个则会停止播放，等待用户选择新的区间再播放。
     */
    public function stopOnNextFrame($value = true)
    {
        return $this->set('stopOnNextFrame', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 指定为视频类型
     */
    public function type($value = 'video')
    {
        return $this->set('type', $value);
    }

    /**
     * 可以组件级别用来关闭移动端样式
     */
    public function useMobileUI($value = true)
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 视频类型如： video/x-flv
     */
    public function videoType($value = '')
    {
        return $this->set('videoType', $value);
    }

    /**
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `data.xxx > 5`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
