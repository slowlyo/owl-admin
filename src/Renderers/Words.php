<?php

namespace Slowlyo\SlowAdmin\Renderers;

/**
 * Words
 *
 * @method self staticPlaceholder($value) 静态展示空值占位
 * @method self staticLabelClassName($value) 静态展示表单项Label类名
 * @method self staticInputClassName($value) 静态展示表单项Value类名
 * @method self expendButtonText($value) 展示文字
 * @method self delimiter($value) 分割符
 * @method self disabledOn($value) 是否禁用表达式
 * @method self staticOn($value) 是否静态展示表达式
 * @method self static($value) 是否静态展示
 * @method self staticClassName($value) 静态展示表单项类名
 * @method self inTag($value) useTag 当数据是数组时，是否使用tag的方式展示
 * @method self disabled($value) 是否禁用
 * @method self hidden($value) 是否隐藏
 * @method self onEvent($value) 事件动作配置
 * @method self limit($value) 展示限制, 为0时也无限制
 * @method self expendButton($value) 展示文字
 * @method self hiddenOn($value) 是否隐藏表达式
 * @method self id($value) 组件唯一 id，主要用于日志采集
 * @method self visible($value) 是否显示
 * @method self visibleOn($value) 是否显示表达式
 * @method self staticSchema($value) 
 * @method self type($value) 
 * @method self collapseButtonText($value) 收起文字
 * @method self collapseButton($value) 展示文字
 * @method self className($value) 容器 css 类名
 * @method self words($value) tags数据
 */
class Words extends BaseRenderer
{
    public string $type = 'words';
}
