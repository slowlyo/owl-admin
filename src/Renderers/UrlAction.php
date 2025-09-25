<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * UrlAction
 * 
 * @author slowlyo
 * @version 6.13.0
 */
class UrlAction extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'action');
$this->set('actionType', 'url');

        $this->set('type', 'action');
    }

    /**
     * 指定为打开链接 可选值: prev | next | cancel | close | submit | confirm | add | reset | reset-and-submit
     */
    public function actionType($value = 'url')
    {
        return $this->set('actionType', $value);
    }

    /**
     * 激活状态时的类名
     */
    public function activeClassName($value = '')
    {
        return $this->set('activeClassName', $value);
    }

    /**
     * 激活状态时的样式
     */
    public function activeLevel($value = '')
    {
        return $this->set('activeLevel', $value);
    }

    /**
     * 角标
     */
    public function badge($value = '')
    {
        return $this->set('badge', $value);
    }

    /**
     * 是否新窗口打开
     */
    public function blank($value = true)
    {
        return $this->set('blank', $value);
    }

    /**
     * 是否为块状展示，默认为内联。
     */
    public function block($value = true)
    {
        return $this->set('block', $value);
    }

    /**
     * 子内容
     */
    public function body($value = '')
    {
        return $this->set('body', $value);
    }

    /**
     * 容器 css 类名 (css类名，配置字符串，或者对象。    className: "red"用对象配置时意味着你能跟表达式一起搭配使用，如：    className: {         "red": "data.progress > 80",         "blue": "data.progress > 60"     })
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 如果按钮在弹框中，可以配置这个动作完成后是否关闭弹窗，或者指定关闭目标弹框。
     */
    public function close($value = '')
    {
        return $this->set('close', $value);
    }

    /**
     * 提示文字，配置了操作前会要求用户确认。
     */
    public function confirmText($value = '')
    {
        return $this->set('confirmText', $value);
    }

    /**
     * 确认弹窗标题
     */
    public function confirmTitle($value = '')
    {
        return $this->set('confirmTitle', $value);
    }

    /**
     * 点击后的禁止倒计时（秒）
     */
    public function countDown($value = '')
    {
        return $this->set('countDown', $value);
    }

    /**
     * 倒计时文字自定义
     */
    public function countDownTpl($value = '')
    {
        return $this->set('countDownTpl', $value);
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
     * 是否在动作结束前禁用按钮
     */
    public function disabledOnAction($value = true)
    {
        return $this->set('disabledOnAction', $value);
    }

    /**
     * 禁用时的文案提示。
     */
    public function disabledTip($value = '')
    {
        return $this->set('disabledTip', $value);
    }

    /**
     * 编辑器配置，运行时可以忽略
     */
    public function editorSetting($value = '')
    {
        return $this->set('editorSetting', $value);
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
     * 键盘快捷键
     */
    public function hotKey($value = '')
    {
        return $this->set('hotKey', $value);
    }

    /**
     * 点击后打开的链接地址
     */
    public function href($value = '')
    {
        return $this->set('href', $value);
    }

    /**
     * 按钮图标， iconfont 的类名
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * icon 上的css 类名
     */
    public function iconClassName($value = '')
    {
        return $this->set('iconClassName', $value);
    }

    /**
     * 主要用于用户行为跟踪里区分是哪个按钮
     */
    public function id($value = '')
    {
        return $this->set('id', $value);
    }

    /**
     * 按钮文字
     */
    public function label($value = '')
    {
        return $this->set('label', $value);
    }

    /**
     * 按钮样式 可选值: info | success | warning | danger | link | primary | dark | light | secondary
     */
    public function level($value = '')
    {
        return $this->set('level', $value);
    }

    /**
     * 设置链接
     */
    public function link($value = '')
    {
        return $this->set('link', $value);
    }

    /**
     * loading 上的css 类名
     */
    public function loadingClassName($value = '')
    {
        return $this->set('loadingClassName', $value);
    }

    /**
     * 是否显示loading效果
     */
    public function loadingOn($value = '')
    {
        return $this->set('loadingOn', $value);
    }

    /**
     * 是否将弹框中数据 merge 到父级作用域。
     */
    public function mergeData($value = true)
    {
        return $this->set('mergeData', $value);
    }

    /**
     * 自定义事件处理函数
     */
    public function onClick($value = '')
    {
        return $this->set('onClick', $value);
    }

    /**
     * 事件动作配置
     */
    public function onEvent($value = '')
    {
        return $this->set('onEvent', $value);
    }

    /**
     * 
     */
    public function primary($value = true)
    {
        return $this->set('primary', $value);
    }

    /**
     * 当按钮时批量操作按钮时，默认必须有勾选元素才能可点击，如果此属性配置成 false，则没有点选成员也能点击。
     */
    public function requireSelected($value = true)
    {
        return $this->set('requireSelected', $value);
    }

    /**
     * 如果按钮在form中，配置此属性会要求用户把指定的字段通过验证后才会触发行为。
     */
    public function required($value = '')
    {
        return $this->set('required', $value);
    }

    /**
     * 右侧按钮图标， iconfont 的类名
     */
    public function rightIcon($value = '')
    {
        return $this->set('rightIcon', $value);
    }

    /**
     * 右侧 icon 上的 css 类名
     */
    public function rightIconClassName($value = '')
    {
        return $this->set('rightIconClassName', $value);
    }

    /**
     * 按钮大小 可选值: xs | sm | md | lg
     */
    public function size($value = '')
    {
        return $this->set('size', $value);
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
     * 组件样式
     */
    public function style($value = '')
    {
        return $this->set('style', $value);
    }

    /**
     * 
     */
    public function tabIndex($value = '')
    {
        return $this->set('tabIndex', $value);
    }

    /**
     * 可以指定让谁来触发这个动作。
     */
    public function target($value = '')
    {
        return $this->set('target', $value);
    }

    /**
     * 
     */
    public function testid($value = '')
    {
        return $this->set('testid', $value);
    }

    /**
     * 提示文字内容
     */
    public function tooltip($value = '')
    {
        return $this->set('tooltip', $value);
    }

    /**
     *  可选值: top | right | bottom | left
     */
    public function tooltipPlacement($value = '')
    {
        return $this->set('tooltipPlacement', $value);
    }

    /**
     * 指定按钮类型，支持 button、submit或者reset三种类型。
     */
    public function type($value = '')
    {
        return $this->set('type', $value);
    }

    /**
     * 打开的目标地址
     */
    public function url($value = '')
    {
        return $this->set('url', $value);
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
