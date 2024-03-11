<?php

use Illuminate\Support\Facades\Schema;

if (!function_exists('admin_url')) {
    function admin_url($path = null, $needPrefix = false)
    {
        $prefix = $needPrefix ? '/' . \Slowlyo\OwlAdmin\Admin::config('admin.route.prefix') : '';

        return $prefix . '/' . trim($path, '/');
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
     * @param int   $parentId
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
            $disk = \Slowlyo\OwlAdmin\Admin::config('admin.upload.disk');

            if (config("filesystems.disks.{$disk}")) {
                $src = \Illuminate\Support\Facades\Storage::disk($disk)->url($path);
            } else {
                $src = '';
            }
        }
        $scheme = 'http:';
        if (\Slowlyo\OwlAdmin\Admin::config('admin.https', false)) {
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
    /**
     * @param $type
     *
     * @return \Slowlyo\OwlAdmin\Renderers\Amis|\Slowlyo\OwlAdmin\Renderers\Component
     */
    function amis($type = null)
    {
        if (filled($type)) {
            return \Slowlyo\OwlAdmin\Renderers\Component::make()->setType($type);
        }

        return \Slowlyo\OwlAdmin\Renderers\Amis::make();
    }
}

if (!function_exists('amisMake')) {
    /**
     * @return \Slowlyo\OwlAdmin\Renderers\Amis
     * @deprecated
     */
    function amisMake()
    {
        return \Slowlyo\OwlAdmin\Renderers\Amis::make();
    }
}

if (!function_exists('admin_encode')) {
    function admin_encode($str)
    {
        return \Illuminate\Support\Facades\Crypt::encryptString($str);
    }
}

if (!function_exists('admin_decode')) {
    function admin_decode($decodeStr)
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
        $storage = \Illuminate\Support\Facades\Storage::disk(\Slowlyo\OwlAdmin\Admin::config('admin.upload.disk'));

        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn($value) => $value ? admin_resource_full_path($value) : '',
            set: fn($value) => str_replace($storage->url(''), '', $value)
        );
    }
}

if (!function_exists('file_upload_handle_multi')) {
    /**
     * 处理文件上传回显问题 (多个)
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    function file_upload_handle_multi()
    {
        $storage = \Illuminate\Support\Facades\Storage::disk(\Slowlyo\OwlAdmin\Admin::config('admin.upload.disk'));

        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: function ($value) use ($storage) {
                return array_map(fn($item) => $item ? admin_resource_full_path($item) : '', explode(',', $value));
            },
            set: function ($value) use ($storage) {
                if (is_string($value)) {
                    return str_replace($storage->url(''), '', $value);
                }

                $list = array_map(fn($item) => str_replace($storage->url(''), '', $item), \Illuminate\Support\Arr::wrap($value));

                return implode(',', $list);
            }
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
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE);
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

if (!function_exists('admin_user')) {
    function admin_user()
    {
        return \Slowlyo\OwlAdmin\Admin::user();
    }
}

if (!function_exists('admin_abort')) {
    /**
     * 抛出异常
     *
     * @param string $message           异常信息
     * @param array  $data              异常数据
     * @param int    $doNotDisplayToast 是否显示提示 (解决在 amis 中抛出异常时，会显示两次提示的问题)
     *
     * @return mixed
     * @throws null
     */
    function admin_abort($message = '', $data = [], $doNotDisplayToast = 0)
    {
        throw new \Slowlyo\OwlAdmin\Exceptions\AdminException($message, $data, $doNotDisplayToast);
    }

    function amis_abort($message = '', $data = [])
    {
        admin_abort($message, $data, 1);
    }

    /**
     * 如果条件成立，抛出异常
     *
     * @param boolean $flag              条件
     * @param string  $message           异常信息
     * @param array   $data              异常数据
     * @param int     $doNotDisplayToast 是否显示提示 (解决在 amis 中抛出异常时，会显示两次提示的问题)
     *
     * @return void
     */
    function admin_abort_if($flag, $message = '', $data = [], $doNotDisplayToast = 0)
    {
        if ($flag) {
            admin_abort($message, $data, $doNotDisplayToast);
        }
    }

    function amis_abort_if($flag, $message = '', $data = [])
    {
        admin_abort_if($flag, $message, $data, 1);
    }
}
