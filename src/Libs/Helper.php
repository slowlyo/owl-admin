<?php

namespace Slowlyo\SlowAdmin\Libs;

use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class Helper
{
    /**
     * 把给定的值转化为数组.
     *
     * @param $value
     * @param bool $filter
     *
     * @return array
     */
    public static function array($value, bool $filter = true): array
    {
        if ($value === null || $value === '' || $value === []) {
            return [];
        }

        if ($value instanceof \Closure) {
            $value = $value();
        }

        if (is_array($value)) {
        } else if ($value instanceof Jsonable) {
            $value = json_decode($value->toJson(), true);
        } else if ($value instanceof Arrayable) {
            $value = $value->toArray();
        } else if (is_string($value)) {
            $array = null;

            try {
                $array = json_decode($value, true);
            } catch (\Throwable $e) {
            }

            $value = is_array($array) ? $array : explode(',', $value);
        } else {
            $value = (array)$value;
        }

        return $filter ? array_filter($value, function ($v) {
            return $v !== '' && $v !== null;
        }) : $value;
    }

    /**
     * @param string $name
     * @param string $symbol
     *
     * @return mixed
     */
    public static function slug(string $name, string $symbol = '-')
    {
        $text = preg_replace_callback('/([A-Z])/', function ($text) use ($symbol) {
            return $symbol . strtolower($text[1]);
        }, $name);

        return str_replace('_', $symbol, ltrim($text, $symbol));
    }

    /**
     * @param mixed $command
     * @param int $timeout
     * @param null $input
     * @param null $cwd
     *
     * @return Process
     */
    public static function process($command, $timeout = 100, $input = null, $cwd = null)
    {
        $parameters = [
            $command,
            $cwd,
            [],
            $input,
            $timeout,
        ];

        return is_string($command)
            ? Process::fromShellCommandline(...$parameters)
            : new Process(...$parameters);
    }

    /**
     * 判断两个值是否相等.
     *
     * @param $value1
     * @param $value2
     *
     * @return bool
     */
    public static function equal($value1, $value2)
    {
        if ($value1 === null || $value2 === null) {
            return false;
        }

        if (!is_scalar($value1) || !is_scalar($value2)) {
            return $value1 === $value2;
        }

        return (string)$value1 === (string)$value2;
    }

    /**
     * 获取文件名称.
     *
     * @param string $name
     *
     * @return array|mixed
     */
    public static function basename($name)
    {
        if (!$name) {
            return $name;
        }

        return last(explode('/', $name));
    }

    /**
     * 获取类名或对象的文件路径.
     *
     * @param string|object $class
     *
     * @return string
     */
    public static function guessClassFileName($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        try {
            if (class_exists($class)) {
                return (new \ReflectionClass($class))->getFileName();
            }
        } catch (\Throwable $e) {
        }

        $class = trim($class, '\\');

        $composer = Composer::parse(base_path('composer.json'));

        $map = collect($composer->autoload['psr-4'] ?? [])->mapWithKeys(function ($path, $namespace) {
            $namespace = trim($namespace, '\\') . '\\';

            return [$namespace => [$namespace, $path]];
        })->sortBy(function ($_, $namespace) {
            return strlen($namespace);
        }, SORT_REGULAR, true);

        $prefix = explode($class, '\\')[0];

        if ($map->isEmpty()) {
            if (Str::startsWith($class, 'App\\')) {
                $values = ['App\\', 'app/'];
            }
        } else {
            $values = $map->filter(function ($_, $k) use ($class) {
                return Str::startsWith($class, $k);
            })->first();
        }

        if (empty($values)) {
            $values = [$prefix . '\\', self::slug($prefix) . '/'];
        }

        [$namespace, $path] = $values;

        return base_path(str_replace([$namespace, '\\'], [$path, '/'], $class)) . '.php';
    }
}
