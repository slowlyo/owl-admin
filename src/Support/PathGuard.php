<?php

namespace Slowlyo\OwlAdmin\Support;

class PathGuard
{
    /**
     * 校验 PHP 类短名是否仅含安全标识符字符（单段，无路径分隔符）。
     */
    public static function isValidPhpClassShortName(string $name): bool
    {
        return (bool) preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $name);
    }

    /**
     * 校验 Composer 包名是否为 vendor/package 且各段字符安全。
     */
    public static function isValidComposerPackageName(string $name): bool
    {
        if (substr_count($name, '/') !== 1) {
            return false;
        }

        [$vendor, $package] = explode('/', $name, 2);

        foreach ([$vendor, $package] as $segment) {
            if ($segment === '' || $segment === '.' || $segment === '..') {
                return false;
            }

            if (!preg_match('/^[a-z0-9][a-z0-9_.-]*$/i', $segment)) {
                return false;
            }
        }

        return true;
    }

    /**
     * 判断目标路径在规范化后是否位于指定根目录内（不要求目标已存在）。
     */
    public static function isPathInsideDirectory(string $path, string $directory): bool
    {
        if (str_contains($path, "\0")) {
            return false;
        }

        $directory = self::normalizePath($directory);
        $path      = self::normalizePath($path);

        if ($directory === '' || $path === '') {
            return false;
        }

        return $path === $directory || str_starts_with($path . '/', $directory . '/');
    }

    /**
     * 对已存在路径做 realpath 后校验是否位于根目录内。
     */
    public static function isRealPathInsideDirectory(string $path, string $directory): bool
    {
        $directoryReal = realpath($directory);

        if ($directoryReal === false) {
            return false;
        }

        $pathReal = realpath($path);

        if ($pathReal === false) {
            return false;
        }

        $directoryReal = rtrim(str_replace('\\', '/', $directoryReal), '/');
        $pathReal      = rtrim(str_replace('\\', '/', $pathReal), '/');

        return $pathReal === $directoryReal || str_starts_with($pathReal . '/', $directoryReal . '/');
    }

    /**
     * 解析路径中的 . 与 ..，得到不含 .. 的规范化路径。
     */
    public static function normalizePath(string $path): string
    {
        $path = str_replace('\\', '/', $path);

        $real = realpath($path);
        if ($real !== false) {
            return rtrim(str_replace('\\', '/', $real), '/');
        }

        $absolute = str_starts_with($path, '/');
        $parts    = [];

        foreach (explode('/', $path) as $part) {
            if ($part === '' || $part === '.') {
                continue;
            }

            if ($part === '..') {
                if ($parts === []) {
                    return '';
                }

                array_pop($parts);

                continue;
            }

            $parts[] = $part;
        }

        $normalized = implode('/', $parts);

        if ($absolute) {
            $normalized = '/' . $normalized;
        }

        return rtrim($normalized, '/');
    }
}
