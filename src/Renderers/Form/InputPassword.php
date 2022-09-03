<?php

namespace Slowlyo\SlowAdmin\Renderers\Form;

/**
 * <b>InputPassword 密码输框</b><br/>
 *
 * @link https://aisuda.bce.baidu.com/amis/zh-CN/components/form/input-password
 *
 * @method self revealPassword($value = true) 是否展示密码显/隐按钮
 */
class InputPassword extends InputText
{
    public string $type = 'input-password';
}
