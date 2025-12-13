<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Tasks 渲染器，格式说明 文档：https://aisuda.bce.baidu.com/amis/zh-CN/components/tasks
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class Tasks extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'tasks');
    }

    /**
     * css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     }
     */
    public function btnClassName($value = '')
    {
        return $this->set('btnClassName', $value);
    }

    /**
     * 操作按钮文字
     */
    public function btnText($value = '上线')
    {
        return $this->set('btnText', $value);
    }

    /**
     * 
     */
    public function canRetryStatusCode($value = '')
    {
        return $this->set('canRetryStatusCode', $value);
    }

    /**
     * 用来获取任务状态的 API，当没有进行时任务时不会发送。 (用来获取任务状态的 API，当没有进行时任务时不会发送。)
     */
    public function checkApi($value = '')
    {
        return $this->set('checkApi', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 是否禁用
     */
    public function disabled($value = true)
    {
        return $this->set('disabled', $value);
    }

    /**
     * 是否禁用表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 
     */
    public function errorStatusCode($value = '')
    {
        return $this->set('errorStatusCode', $value);
    }

    /**
     * 
     */
    public function finishStatusCode($value = '')
    {
        return $this->set('finishStatusCode', $value);
    }

    /**
     * 是否隐藏
     */
    public function hidden($value = true)
    {
        return $this->set('hidden', $value);
    }

    /**
     * 是否隐藏表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 
     */
    public function initialStatusCode($value = '')
    {
        return $this->set('initialStatusCode', $value);
    }

    /**
     * 当有任务进行中，会每隔一段时间再次检测，而时间间隔就是通过此项配置，默认 3s。
     */
    public function interval($value = 3000)
    {
        return $this->set('interval', $value);
    }

    /**
     * 状态项列表
     */
    public function items($value = '')
    {
        return $this->set('items', $value);
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
    public function loadingStatusCode($value = '')
    {
        return $this->set('loadingStatusCode', $value);
    }

    /**
     * 组件名字，这个名字可以用来定位，用于组件通信
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 操作列说明
     */
    public function operationLabel($value = '')
    {
        return $this->set('operationLabel', $value);
    }

    /**
     * 如果任务失败，且可以重试，提交的时候会使用此 API (如果任务失败，且可以重试，提交的时候会使用此 API)
     */
    public function reSubmitApi($value = '')
    {
        return $this->set('reSubmitApi', $value);
    }

    /**
     * 
     */
    public function readyStatusCode($value = '')
    {
        return $this->set('readyStatusCode', $value);
    }

    /**
     * 备注列说明
     */
    public function remarkLabel($value = '备注')
    {
        return $this->set('remarkLabel', $value);
    }

    /**
     * 配置容器重试按钮 className (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function retryBtnClassName($value = 'btn-sm btn-danger')
    {
        return $this->set('retryBtnClassName', $value);
    }

    /**
     * 重试操作按钮文字
     */
    public function retryBtnText($value = '重试')
    {
        return $this->set('retryBtnText', $value);
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
     * 是否静态展示表达式 (表达式，语法 `${xxx > 5}`。)
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
     * 状态列说明
     */
    public function statusLabel($value = '状态')
    {
        return $this->set('statusLabel', $value);
    }

    /**
     * 状态显示对应的类名配置。
     */
    public function statusLabelMap($value = array (
  0 => 'label-warning',
  1 => 'label-info',
  2 => 'label-success',
  3 => 'label-danger',
  4 => 'label-default',
  5 => 'label-danger',
))
    {
        return $this->set('statusLabelMap', $value);
    }

    /**
     * 状态显示对应的文字显示配置。
     */
    public function statusTextMap($value = '["未开始", "就绪", "进行中", "出错", "已完成", "出错"],')
    {
        return $this->set('statusTextMap', $value);
    }

    /**
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 提交任务使用的 API (提交任务使用的 API)
     */
    public function submitApi($value = '')
    {
        return $this->set('submitApi', $value);
    }

    /**
     * 配置 table className (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function tableClassName($value = '')
    {
        return $this->set('tableClassName', $value);
    }

    /**
     * 任务名称列说明
     */
    public function taskNameLabel($value = '任务名称')
    {
        return $this->set('taskNameLabel', $value);
    }

    /**
     * 
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 指定为任务类型
     */
    public function type($value = 'tasks')
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
     * 是否显示
     */
    public function visible($value = true)
    {
        return $this->set('visible', $value);
    }

    /**
     * 是否显示表达式 (表达式，语法 `${xxx > 5}`。)
     */
    public function visibleOn($value = '')
    {
        return $this->set('visibleOn', $value);
    }


}
