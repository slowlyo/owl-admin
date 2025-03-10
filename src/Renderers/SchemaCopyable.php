<?php

namespace Slowlyo\OwlAdmin\Renderers;

/**
 * SchemaCopyable
 * 
 * @author slowlyo
 * @version 6.10.0
 */
class SchemaCopyable extends BaseRenderer
{
    public function __construct()
    {
        

    }

    /**
     * 配置复制时的内容模板。 (支持两种语法，但是不能混着用。分别是：1. `${xxx}` 或者 `${xxx|upperCase}` 2. `<%= data.xxx %>`
更多文档：https://aisuda.bce.baidu.com/amis/zh-CN/docs/concepts/template)
     */
    public function content($value = '')
    {
        return $this->set('content', $value);
    }

    /**
     * 可以配置图标 (iconfont 里面的类名。)
     */
    public function icon($value = '')
    {
        return $this->set('icon', $value);
    }

    /**
     * 提示文字内容
     */
    public function tooltip($value = '')
    {
        return $this->set('tooltip', $value);
    }


}
