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

if (!function_exists('array2tree')) {
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
                $src = \Illuminate\Support\Facades\Storage::disk($disk)->url($path);
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

if (!function_exists('admin_path')) {
    function admin_path($path = '')
    {
        return ucfirst(config('admin.directory')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}


if (!function_exists('amis')) {
    function amis($type = null): \Slowlyo\OwlAdmin\Renderers\Component
    {
        $component = \Slowlyo\OwlAdmin\Renderers\Component::make();

        if ($type) {
            $component->setType($type);
        }

        return $component;
    }
}

if (!function_exists('amisMake')) {
    function amisMake(): \Slowlyo\OwlAdmin\Renderers\Amis
    {
        return \Slowlyo\OwlAdmin\Renderers\Amis::make();
    }
}

if (!function_exists('admin_encode')) {
    function admin_encode($str, $key = null)
    {
        return \Illuminate\Support\Facades\Crypt::encryptString($str);
    }
}

if (!function_exists('admin_decode')) {
    function admin_decode($decodeStr, $key = null)
    {
        try {
            $str = \Illuminate\Support\Facades\Crypt::decryptString($decodeStr);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            $str = '';
        }

        return $str;
    }
}


if (!function_exists('file_upload_handle')) {
    /**
     * 处理文件上传回显问题
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    function file_upload_handle()
    {
        $storage = \Illuminate\Support\Facades\Storage::disk(config('admin.upload.disk'));

        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn($value) => $value ? $storage->url($value) : '',
            set: fn($value) => str_replace($storage->url(''), '', $value)
        );
    }
}

// 是否是json字符串
if (!function_exists('is_json')) {
    /**
     * 是否是json字符串
     *
     * @param $string
     *
     * @return bool
     */
    function is_json($string)
    {
        if (!is_string($string)) {
            return false;
        }
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        return \Slowlyo\OwlAdmin\Services\AdminSettingService::make();
    }
}

if (!function_exists('admin_extension_path')) {
    /**
     * @param string|null $path
     *
     * @return string
     */
    function admin_extension_path(?string $path = null)
    {
        $dir = rtrim(config('admin.extension.dir'), '/') ?: base_path('extensions');

        $path = ltrim($path, '/');

        return $path ? $dir . '/' . $path : $dir;
    }
}
