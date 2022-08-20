<?php

use Illuminate\Support\Facades\Schema;

if (!function_exists('admin_url')) {
    function admin_url($path = null): string|\Illuminate\Contracts\Routing\UrlGenerator|\Illuminate\Contracts\Foundation\Application
    {
        return url(config('admin.route.prefix') . '/' . $path);
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
    function table_columns($tableName): array
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
    function array2tree(array $list, int $parentId = 0): array
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
        $src = preg_replace('/^http[s]{0,1}:/', $scheme, $src, 1);

        return $src;
    }
}
