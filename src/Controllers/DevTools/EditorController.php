<?php

namespace Slowlyo\OwlAdmin\Controllers\DevTools;

use Illuminate\Support\Arr;
use Slowlyo\OwlAdmin\Renderers\RendererMap;
use Slowlyo\OwlAdmin\Controllers\AdminController;

class EditorController extends AdminController
{
    public function index()
    {
        $schema = $this->parse(request('schema'));

        return $this->response()->success(compact('schema'));
    }

    public function parse($json, $level = 1)
    {
        $code    = '';
        $map     = RendererMap::$map;
        $mapKeys = array_keys($map);
        $space   = "\n" . str_repeat("\t", $level);

        if ($json['type'] ?? null) {
            // 组件
            if (in_array($json['type'], $mapKeys)) {
                $className = str_replace('Slowlyo\\OwlAdmin\\Renderers\\', '', $map[$json['type']]);
                $code      .= $space . sprintf('amis()->%s()', $className);
            } else {
                $code .= $space . sprintf('amis(\'%s\')', $json['type']);
            }

            // 属性
            foreach ($json as $key => $value) {
                if ($key == 'type') {
                    continue;
                }
                if (is_array($value)) {
                    $code .= sprintf('->%s(%s)', $key, $this->parse($value, $level + 1));
                    continue;
                }
                $code .= sprintf('->%s(\'%s\')', $key, $this->escape($value));
            }
        } else {
            // json 转 php 数组
            $code = '[';
            foreach ($json as $key => $value) {
                if (!is_array($value)) {
                    $code .= $space . sprintf('\'%s\' => \'%s\',', $key, $this->escape($value));
                    continue;
                }

                if (Arr::isList($json)) {
                    $code .= $space . sprintf('%s,', $this->parse($value, $level));
                    continue;
                }

                $code .= $space . sprintf('\'%s\' => %s,', $key, $this->parse($value, $level + 1));
            }
            $code .= substr($space, 0, -1) . ']';
        }

        $code = preg_replace("/\[\n\t*]/", "[]", $code);

        return preg_replace("/\n\t*\n/", "\n", $code);
    }

    /**
     * 转义单引号
     *
     * @param $string
     *
     * @return string|string[]
     */
    public function escape($string)
    {
        return str_replace("'", "\'", $string);
    }
}
