<?php

namespace Slowlyo\SlowAdmin\Extend;

use Slowlyo\SlowAdmin\Libs\Helper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Slowlyo\SlowAdmin\Traits\ErrorTrait;

class Extension
{
    use ErrorTrait;

    protected string $basePath = '';

    protected Filesystem $filesystem;

    protected string $namespace;

    protected string $className;

    protected string $extensionName;

    protected string $package;

    protected string $extensionDir;

    protected array $dirs = [
        'database/migrations',
        'src/Models',
        'src/Http/Controllers',
        'src/Http/Middleware',
    ];

    public static function make()
    {
        return new self();
    }

    /**
     * Execute the console command.
     *
     * @param $name
     * @param $namespace
     *
     * @return bool
     */
    public function createDir($name, $namespace)
    {
        if (!preg_match('/^[\w\-_]+\/[\w\-_]+$/', $name)) {
            return $this->setError('无效的扩展名称');
        }

        $this->filesystem = app('files');
        $this->namespace  = $namespace;

        $this->extensionDir = admin_extension_path();

        if (!file_exists($this->extensionDir)) {
            $this->makeDir();
        }

        $this->package       = str_replace('.', '/', $name);
        $this->extensionName = str_replace('/', '.', $this->package);

        $this->basePath = rtrim($this->extensionDir, '/') . '/' . ltrim($this->package, '/');

        if (is_dir($this->basePath)) {
            return $this->setError(sprintf('The extension [%s] already exists!', $this->package));
        }

        $this->makeDir($this->dirs);
        $this->makeFiles();

        return true;
    }

    /**
     * Make extension files.
     */
    protected function makeFiles()
    {
        $this->namespace = $this->getRootNameSpace();

        $this->className = ucfirst(Str::camel(basename($this->package)));

        // copy files
        $this->copyFiles();

        // make composer.json
        $composerContents = str_replace(
            ['{package}', '{alias}', '{namespace}', '{className}'],
            [$this->package, '', str_replace('\\', '\\\\', $this->namespace) . '\\\\', $this->className],
            file_get_contents(__DIR__ . '/stubs/composer.json.stub')
        );
        $this->putFile('composer.json', $composerContents);

        $basePackage = Helper::slug(basename($this->package));

        // make class
        $classContents = str_replace(
            ['{namespace}', '{className}', '{title}', '{path}', '{basePackage}', '{property}', '{registerTheme}'],
            [
                $this->namespace,
                $this->className,
                Str::title($this->className),
                $basePackage,
                $basePackage,
                $this->makeProviderContent(),
                $this->makeRegisterThemeContent(),
            ],
            file_get_contents(__DIR__ . '/stubs/extension.stub')
        );
        $this->putFile("src/{$this->className}ServiceProvider.php", $classContents);

        // make controller
        $controllerContent = str_replace(
            ['{namespace}', '{className}', '{name}'],
            [$this->namespace, $this->className, $this->extensionName],
            file_get_contents(__DIR__ . '/stubs/controller.stub')
        );
        $this->putFile("src/Http/Controllers/{$this->className}Controller.php", $controllerContent);

        // make routes
        $routesContent = str_replace(
            ['{namespace}', '{className}', '{path}'],
            [$this->namespace, $this->className, $basePackage],
            file_get_contents(__DIR__ . '/stubs/routes.stub')
        );
        $this->putFile('src/Http/routes.php', $routesContent);
    }

    protected function makeProviderContent()
    {
        return '';
    }

    protected function makeRegisterThemeContent()
    {
        return null;
    }

    protected function copyFiles()
    {
        $files = [
            __DIR__ . '/stubs/.gitignore.stub' => '.gitignore',
            __DIR__ . '/stubs/README.md.stub'  => 'README.md',
        ];

        $this->copy($files);
    }

    /**
     * Get root namespace for this package.
     *
     * @return array|null|string
     */
    protected function getRootNameSpace()
    {
        [$vendor, $name] = explode('/', $this->package);

        $default = str_replace(['-'], '', Str::title($vendor) . '\\' . Str::title($name));

        $namespace = $this->namespace;

        return $namespace === 'default' ? $default : $namespace;
    }

    /**
     * Extension path.
     *
     * @param string $path
     *
     * @return string
     */
    protected function extensionPath(string $path = '')
    {
        $path = rtrim($path, '/');

        if (empty($path)) {
            return rtrim($this->basePath, '/');
        }

        return rtrim($this->basePath, '/') . '/' . ltrim($path, '/');
    }

    /**
     * Put contents to file.
     *
     * @param string $to
     * @param string $content
     */
    protected function putFile(string $to, string $content)
    {
        $to = $this->extensionPath($to);

        $this->filesystem->put($to, $content);
    }

    /**
     * Copy files to extension path.
     *
     * @param array|string $from
     * @param string|null $to
     */
    protected function copy(array|string $from, string $to = null)
    {
        if (is_array($from) && is_null($to)) {
            foreach ($from as $key => $value) {
                $this->copy($key, $value);
            }

            return;
        }

        if (!file_exists($from)) {
            return;
        }

        $to = $this->extensionPath($to);

        $this->filesystem->copy($from, $to);
    }

    /**
     * Make new directory.
     *
     * @param array|string $paths
     */
    protected function makeDir(array|string $paths = '')
    {
        foreach ((array)$paths as $path) {
            $path = $this->extensionPath($path);

            $this->filesystem->makeDirectory($path, 0755, true, true);
        }
    }
}
