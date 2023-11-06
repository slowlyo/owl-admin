<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Code 代码高亮
 *
 * @author  slowlyo
 * @version 3.5.2
 */
class Code extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'code');
    }

    /**
     * 外层 CSS 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 主题，还有 'vs-dark'
     */
    public function editorTheme($value = '')
    {
        return $this->set('editorTheme', $value);
    }

    /**
     * 所使用的高亮语言，默认是 plaintext
     */
    public function language($value = '')
    {
        return $this->set('language', $value);
    }

    /**
     * 在其他组件中，时，用作变量映射
     */
    public function name($value = '')
    {
        return $this->set('name', $value);
    }

    /**
     * 默认 tab 大小
     */
    public function tabSize($value = '')
    {
        return $this->set('tabSize', $value);
    }

    /**
     * 指定为 code 渲染器。
     */
    public function type($value = 'code')
    {
        return $this->set('type', $value);
    }

    /**
     * 显示的颜色值
     */
    public function value($value = '')
    {
        return $this->set('value', $value);
    }

    /**
     * 是否折行
     */
    public function wordWrap($value = true)
    {
        return $this->set('wordWrap', $value);
    }


}
