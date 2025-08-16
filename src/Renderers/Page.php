<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * amis Page 渲染器。详情请见：https://aisuda.bce.baidu.com/amis/zh-CN/components/page 一个页面只允许有一个 Page 渲染器。
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Page extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'page');


    }

    /**
     * 
     */
    public function aside($value = '')
    {
        return $this->set('aside', $value);
    }

    /**
     * 
     */
    public function asideClassName($value = '')
    {
        return $this->set('asideClassName', $value);
    }

    /**
     * 
     */
    public function asideMaxWidth($value = '')
    {
        return $this->set('asideMaxWidth', $value);
    }

    /**
     * 
     */
    public function asideMinWidth($value = '')
    {
        return $this->set('asideMinWidth', $value);
    }

    /**
     * 
     */
    public function asidePosition($value = '')
    {
        return $this->set('asidePosition', $value);
    }

    /**
     * 
     */
    public function asideResizor($value = '')
    {
        return $this->set('asideResizor', $value);
    }

    /**
     * 
     */
    public function asideSticky($value = '')
    {
        return $this->set('asideSticky', $value);
    }

    /**
     * 
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 
     */
    public function bodyClassName($value = '')
    {
        return $this->set('bodyClassName', $value);
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
    public function css($value = '')
    {
        return $this->set('css', $value);
    }

    /**
     * 
     */
    public function cssVars($value = '')
    {
        return $this->set('cssVars', $value);
    }

    /**
     * 
     */
    public function data($value = '')
    {
        return $this->set('data', $value);
    }

    /**
     * 
     */
    public function definitions($value = '')
    {
        return $this->set('definitions', $value);
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
    public function headerClassName($value = '')
    {
        return $this->set('headerClassName', $value);
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
    public function initApi($value = '')
    {
        return $this->set('initApi', $value);
    }

    /**
     * 
     */
    public function initFetch($value = '')
    {
        return $this->set('initFetch', $value);
    }

    /**
     * 
     */
    public function initFetchOn($value = '')
    {
        return $this->set('initFetchOn', $value);
    }

    /**
     * 
     */
    public function interval($value = '')
    {
        return $this->set('interval', $value);
    }

    /**
     * 
     */
    public function loadingConfig($value = '')
    {
        return $this->set('loadingConfig', $value);
    }

    /**
     * 
     */
    public function messages($value = '')
    {
        return $this->set('messages', $value);
    }

    /**
     * 
     */
    public function mobileCSS($value = '')
    {
        return $this->set('mobileCSS', $value);
    }

    /**
     * 
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
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
    public function pullRefresh($value = '')
    {
        return $this->set('pullRefresh', $value);
    }

    /**
     * 
     */
    public function regions($value = '')
    {
        return $this->set('regions', $value);
    }

    /**
     * 
     */
    public function remark($value = '')
    {
        return $this->set('remark', $value);
    }

    /**
     * 
     */
    public function showErrorMsg($value = '')
    {
        return $this->set('showErrorMsg', $value);
    }

    /**
     * 
     */
    public function silentPolling($value = '')
    {
        return $this->set('silentPolling', $value);
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
    public function stopAutoRefreshWhen($value = '')
    {
        return $this->set('stopAutoRefreshWhen', $value);
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
    public function subTitle($value = '')
    {
        return $this->set('subTitle', $value);
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
    public function title($value = '')
    {
        return $this->set('title', $value);
    }

    /**
     * 
     */
    public function toolbar($value = '')
    {
        return $this->set('toolbar', $value);
    }

    /**
     * 
     */
    public function toolbarClassName($value = '')
    {
        return $this->set('toolbarClassName', $value);
    }

    /**
     * 
     */
    public function type($value = 'page')
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
