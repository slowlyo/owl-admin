<?php

use Illuminate\Support\Facades\Schema;

if (!function_exists('admin_url')) {
    function admin_url($path = null)
    {
        return url(config('admin.route.prefix') . '/' . trim($path, '/'));
    }
}

if (!function_exists('table_columns')) {
    /**
     * 获取表字段
     *
     * @param $tableName
     *
     * @return array
     */
    function table_columns($tableName)
    {
        return Schema::getColumnListing($tableName);
    }
}

if (!function_exists('arr2tree')) {
    /**
     * 生成树状数据
     *
     * @param array $list
     * @param int $parentId
     *
     * @return array
     */
    function array2tree(array $list, int $parentId = 0)
    {
        $data = [];
        foreach ($list as $key => $item) {
            if ($item['parent_id'] == $parentId) {
                $children = array2tree($list, (int)$item['id']);
                !empty($children) && $item['children'] = $children;
                $data[] = $item;
                unset($list[$key]);
            }
        }
        return $data;
    }
}

if (!function_exists('admin_resource_full_path')) {
    function admin_resource_full_path($path, $server = null)
    {
        if (!$path) {
            return '';
        }
        if (url()->isValidUrl($path) || mb_strpos($path, 'data:image') === 0) {
            $src = $path;
        } else if ($server) {
            $src = rtrim($server, '/') . '/' . ltrim($path, '/');
        } else {
            $disk = config('admin.upload.disk');

            if (config("filesystems.disks.{$disk}")) {
                $src = Storage::disk($disk)->url($path);
            } else {
                $src = '';
            }
        }
        $scheme = 'http:';
        if (config('admin.https', false)) {
            $scheme = 'https:';
        }
        return preg_replace('/^http[s]{0,1}:/', $scheme, $src, 1);
    }
}

function admin_path($path = '')
{
    return ucfirst(config('admin.directory')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}


if (!function_exists('amis')) {
    function amis($type = null): \Slowlyo\SlowAdmin\Renderers\Component
    {
        $component = \Slowlyo\SlowAdmin\Renderers\Component::make();

        if ($type) {
            $component->setType($type);
        }

        return $component;
    }
}

if (!function_exists('admin_encode')) {
    function admin_encode($str, $key = null)
    {
        return base64_encode(openssl_encrypt($str, 'DES-ECB', $key ?? config('app.key')));
    }
}

if (!function_exists('admin_decode')) {
    function admin_decode($decodeStr, $key = null)
    {
        $str = openssl_decrypt(base64_decode($decodeStr), 'DES-ECB', $key ?? config('app.key'));

        return $str ?: '';
    }
}
