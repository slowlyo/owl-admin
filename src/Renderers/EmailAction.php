<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * @method self rightIcon($value) 右侧按钮图标， iconfont 的类名
 * @method self badge($value) 角标
 * @method self onClick($value) 自定义事件处理函数
 * @method self visible($value) 是否显示
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self disabledTip($value) 禁用时的文案提示。
 * @method self loadingClassName($value) loading 上的css 类名
 * @method self tooltipPlacement($value)  可选值: top | right | bottom | left | 
 * @method self close($value) 如果按钮在弹框中，可以配置这个动作完成后是否关闭弹窗，或者指定关闭目标弹框。
 * @method self tooltip($value) 
 * @method self required($value) 如果按钮在form中，配置此属性会要求用户把指定的字段通过验证后才会触发行为。
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self type($value) 指定按钮类型，支持 button、submit或者reset三种类型。 可选值: button | submit | reset | 
 * @method self icon($value) 按钮图标， iconfont 的类名
 * @method self mergeData($value) 是否将弹框中数据 merge 到父级作用域。
 * @method self hotKey($value) 键盘快捷键
 * @method self label($value) 按钮文字
 * @method self level($value) 按钮样式 可选值: info | success | warning | danger | link | primary | dark | light | secondary | 
 * @method self loadingOn($value) 是否显示loading效果
 * @method self body($value) 邮件正文
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self block($value) 是否为块状展示，默认为内联。
 * @method self rightIconClassName($value) 右侧 icon 上的 css 类名
 * @method self static($value) 是否静态展示
 * @method self primary($value) 
 * @method self activeLevel($value) 激活状态时的样式
 * @method self countDownTpl($value) 倒计时文字自定义
 * @method self disabledOn($value) 是否禁用表达式
 * @method self hidden($value) 是否隐藏
 * @method self onEvent($value) 事件动作配置
 * @method self to($value) 收件人邮箱
 * @method self cc($value) 抄送邮箱
 * @method self bcc($value) 匿名抄送邮箱
 * @method self subject($value) 邮件主题
 * @method self className($value) 容器 css 类名
 * @method self id($value) 主要用于用户行为跟踪里区分是哪个按钮
 * @method self activeClassName($value) 激活状态时的类名
 * @method self countDown($value) 点击后的禁止倒计时（秒）
 * @method self size($value) 按钮大小 可选值: xs | sm | md | lg | 
 * @method self confirmText($value) 提示文字，配置了操作前会要求用户确认。
 * @method self requireSelected($value) 当按钮时批量操作按钮时，默认必须有勾选元素才能可点击，如果此属性配置成 false，则没有点选成员也能点击。
 * @method self target($value) 可以指定让谁来触发这个动作。
 * @method self disabled($value) 是否禁用
 * @method self staticOn($value) 是否静态展示表达式
 * @method self staticSchema($value) 
 * @method self iconClassName($value) icon 上的css 类名
 * @method self actionType($value) 指定为打开邮箱行为
 */
class EmailAction extends BaseRenderer
{
    public string $actionType = 'email';
    public string $type = 'button';
}
