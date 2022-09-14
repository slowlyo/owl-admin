<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * <b>Video 视频</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/video
 *
 * @method self className($value) 外层 Dom 的类名
 * @method self src($value) 视频地址
 * @method self isLive($value) 是否为直播，视频为直播时需要添加上，支持flv和hls格式
 * @method self videoType($value) 指定直播视频格式
 * @method self poster($value) 视频封面地址
 * @method self muted($value) 是否静音
 * @method self autoPlay($value) 是否自动播放
 * @method self rates($value) 倍数，格式为[1.0, 1.5, 2.0]
 * @method self frames($value) key 是时刻信息，value 可以可以为空，可有设置为图片地址，请看上方示例
 * @method self jumpBufferDuration($value) 点击帧的时候默认是跳转到对应的时刻，如果想提前 3 秒钟，可以设置这个值为 3
 * @method self stopOnNextFrame($value) 到了下一帧默认是接着播放，配置这个会自动停止
 */
class Video extends BaseRenderer
{
    public string $type = 'video';
}
