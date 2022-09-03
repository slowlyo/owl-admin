<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Audio 音频</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/audio
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self inline($value = true) 是否是内联模式
 * @method self src($value) 音频地址
 * @method self loop($value = true) 是否循环播放
 * @method self autoPlay($value = true) 是否自动播放
 * @method self rates($value) 可配置音频播放倍速如：[1.0, 1.5, 2.0]
 * @method self controls($value) 内部模块定制化
 *
 */
class Audio extends BaseRenderer
{
    public string $type = 'audio';
}
