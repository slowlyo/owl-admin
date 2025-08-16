<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * 视频播放器 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/video
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Video extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'video');


    }

    /**
     * 
     */
    public function aspectRatio($value = '')
    {
        return $this->set('aspectRatio', $value);
    }

    /**
     * 
     */
    public function autoPlay($value = '')
    {
        return $this->set('autoPlay', $value);
    }

    /**
     * 
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 
     */
    public function columnsCount($value = '')
    {
        return $this->set('columnsCount', $value);
    }

    /**
     * 
     */
    public function disabled($value = '')
    {
        return $this->set('disabled', $value);
    }

    /**
     * 
     */
    public function disabledOn($value = '')
    {
        return $this->set('disabledOn', $value);
    }

    /**
     * 
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
    }

    /**
     * 
     */
    public function frames($value = '')
    {
        return $this->set('frames', $value);
    }

    /**
     * 
     */
    public function framesClassName($value = '')
    {
        return $this->set('framesClassName', $value);
    }

    /**
     * 
     */
    public function hidden($value = '')
    {
        return $this->set('hidden', $value);
    }

    /**
     * 
     */
    public function hiddenOn($value = '')
    {
        return $this->set('hiddenOn', $value);
    }

    /**
     * 
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 
     */
    public function isLive($value = '')
    {
        return $this->set('isLive', $value);
    }

    /**
     * 
     */
    public function jumpBufferDuration($value = '')
    {
        return $this->set('jumpBufferDuration', $value);
    }

    /**
     * 
     */
    public function jumpFrame($value = '')
    {
        return $this->set('jumpFrame', $value);
    }

    /**
     * 
     */
    public function loop($value = '')
    {
        return $this->set('loop', $value);
    }

    /**
     * 
     */
    public function muted($value = '')
    {
        return $this->set('muted', $value);
    }

    /**
     * 
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 
     */
    public function playerClassName($value = '')
    {
        return $this->set('playerClassName', $value);
    }

    /**
     * 
     */
    public function poster($value = '')
    {
        return $this->set('poster', $value);
    }

    /**
     * 
     */
    public function rates($value = '')
    {
        return $this->set('rates', $value);
    }

    /**
     * 
     */
    public function splitPoster($value = '')
    {
        return $this->set('splitPoster', $value);
    }

    /**
     * 
     */
    public function src($value = '')
    {
        return $this->set('src', $value);
    }

    /**
     * 
     */
    public function static($value = '')
    {
        return $this->set('static', $value);
    }

    /**
     * 
     */
    public function staticClassName($value = '')
    {
        return $this->set('staticClassName', $value);
    }

    /**
     * 
     */
    public function staticInputClassName($value = '')
    {
        return $this->set('staticInputClassName', $value);
    }

    /**
     * 
     */
    public function staticLabelClassName($value = '')
    {
        return $this->set('staticLabelClassName', $value);
    }

    /**
     * 
     */
    public function staticOn($value = '')
    {
        return $this->set('staticOn', $value);
    }

    /**
     * 
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
     * 
     */
    public function stopOnNextFrame($value = '')
    {
        return $this->set('stopOnNextFrame', $value);
    }

    /**
     * 
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 
     */
    public function type($value = 'video')
    {
        return $this->set('type', $value);
    }

    /**
     * 
     */
    public function useMobileUI($value = '')
    {
        return $this->set('useMobileUI', $value);
    }

    /**
     * 
     */
    public function videoType($value = '')
    {
        return $this->set('videoType', $value);
    }

    /**
     * 
     */
    public function visible($value = '')
    {
        return $this->set('visible', $value);
    }

    /**
     * 
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
