<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * Log 实时日志
 *
 * @author  slowlyo
 * @version v3.6.3
 */
class Log extends BaseRenderer
{
    public function __construct()
    {
        $this->set('type', 'log');
    }

    /**
     * 是否自动滚动到底部
     */
    public function autoScroll($value = '')
    {
        return $this->set('autoScroll', $value);
    }

    /**
     * 外层 CSS 类名
     */
    public function className($value = '')
    {
        return $this->set('className', $value);
    }

    /**
     * 关闭 ANSI 颜色支持
     */
    public function disableColor($value = '')
    {
        return $this->set('disableColor', $value);
    }

    /**
     * 返回内容的字符编码
     */
    public function encoding($value = '')
    {
        return $this->set('encoding', $value);
    }

    /**
     * 展示区域高度
     */
    public function height($value = '')
    {
        return $this->set('height', $value);
    }

    /**
     * 最大显示行数
     */
    public function maxLength($value = '')
    {
        return $this->set('maxLength', $value);
    }

    /**
     * 可选日志操作：['stop', 'clear', 'showLineNumber', 'filter']
     */
    public function operation($value = '')
    {
        return $this->set('operation', $value);
    }

    /**
     * 加载中的文字
     */
    public function placeholder($value = '')
    {
        return $this->set('placeholder', $value);
    }

    /**
     * 设置每行高度，将会开启虚拟渲染
     */
    public function rowHeight($value = '')
    {
        return $this->set('rowHeight', $value);
    }

    /**
     * 接口
     */
    public function source($value = '')
    {
        return $this->set('source', $value);
    }

    /**
     * 指定为 log 渲染器。
     */
    public function type($value = 'log')
    {
        return $this->set('type', $value);
    }


}
