<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;
use Slowlyo\OwlAdmin\Models\AdminCodeGenerator;

class BaseGenerator
{
    protected static array $files = [];

    protected string $primaryKey = '';

    protected string $title = '';

    protected AdminCodeGenerator $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public static function make($model): static
    {
        return new static($model);
    }

    public function primary($key): static
    {
        $this->primaryKey = $key;

        return $this;
    }

    public function title($title): static
    {
        $this->title = $title;

        return $this;
    }

    public static function guessClassFileName($class): bool|string
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

        $class        = trim($class, '\\');
        $autoloadFile = base_path('/vendor/autoload.php');
        $loader       = require $autoloadFile;
        $prefix       = explode($class, '\\')[0];
        // 获取并处理命名空间和路径映射
        $map = collect($loader->getPrefixesPsr4())
            ->mapWithKeys(function ($path, $namespace) {
                $namespace = trim($namespace, '\\') . '\\';
                $path      = str_replace([base_path() . '/', base_path() . '\\'], '', realpath(current($path)) . '/');
                return [$namespace => [$namespace, $path]];
            })
            ->sortKeysDesc(SORT_STRING);

        if ($map->isEmpty()) {
            if (Str::startsWith($class, 'App\\')) {
                $values = ['App\\', 'app/'];
            }
        } else {
            $values = $map->filter(function ($_, $k) use ($class) {
                $class = str_replace('/', '\\', $class);
                return Str::startsWith($class, $k);
            })->first();
        }

        if (empty($values)) {
            $values = [$prefix . '\\', self::slug($prefix) . '/'];
        }

        [$namespace, $path] = $values;
        return base_path(str_replace(["/", $namespace, '\\'], ["\\", $path, '/'], $class)) . '.php';
    }

    public static function slug(string $name, string $symbol = '-'): array|string
    {
        $text = preg_replace_callback('/([A-Z])/', function ($text) use ($symbol) {
            return $symbol . strtolower($text[1]);
        }, $name);

        return str_replace('_', $symbol, ltrim($text, $symbol));
    }

    protected function getNamespace($name): string
    {
        return trim(implode('\\', array_slice(explode('\\', str_replace('/', '\\', $name)), 0, -1)), '\\');
    }

    protected function writeFile($name, $type)
    {
        $name = str_replace('/', '\\', $name);
        $path = static::guessClassFileName($name);
        $dir  = dirname($path);

        $files = app('files');

        if (!is_dir($dir)) {
            $files->makeDirectory($dir, 0755, true);
        }

        if ($files->exists($path)) {
            abort(Response::HTTP_BAD_REQUEST, "{$type} [{$name}] already exists!");
        }

        $content = $this->assembly();

        $files->put($path, $content);
        $files->chmod($path, 0777);

        return $path;
    }

    protected function jsonToStringArray($jsonString)
    {
        // 首先，检查输入是否为有效的JSON字符串
        if (!is_json($jsonString)) {
            return $jsonString;
        }

        $dataArray = json_decode($jsonString, true);

        // 遍历数组，确保所有的字符串都正确处理Unicode编码，特别是中文
        array_walk_recursive($dataArray, function (&$item) {
            if (is_string($item)) {
                $item = mb_convert_encoding($item, 'UTF-8', 'UTF-8');
            }
        });

        // 使用var_export()生成数组的字符串表示，然后将其返回
        $phpArrayString = var_export($dataArray, true);

        // 转换为短数组语法
        $phpArrayString = preg_replace('/array \(/', '[', $phpArrayString);
        $phpArrayString = preg_replace('/\)$/', ']', $phpArrayString);
        $phpArrayString = str_replace(')', ']', $phpArrayString);

        // 去除数字索引
        $phpArrayString = preg_replace('/\d+ => /', '', $phpArrayString);

        // 去除多余的空格和换行，使输出更为紧凑
        $phpArrayString = preg_replace('/ =>\s+\[/', '=> [', $phpArrayString);

        return str_replace(["\r\n", "\r", "\n", "\t", "  "], '', $phpArrayString);
    }

    protected function buildComponentProperty($property)
    {
        return collect($property)->map(function ($item) {
            $_val = Arr::get($item, 'value');

            if (is_json($_val)) {
                return '->' . Arr::get($item, 'name') . '(' . $this->jsonToStringArray($_val) . ')';
            }

            if (filled($_val) && !in_array($_val, ['true', 'false']) && !is_numeric($_val)) {
                $_val = "'{$_val}'";
            }

            return '->' . Arr::get($item, 'name') . '(' . $_val . ')';
        })->implode('');
    }
}
