<?php

namespace Slowlyo\OwlAdmin\Libs\CodeGenerator;

use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ServiceGenerator extends BaseGenerator
{
    protected string $stub = __DIR__ . '/stubs/service.stub';

    public function generate($serviceName, $modelName): bool|string
    {
        $name      = str_replace('/', '\\', $serviceName);
        $modelName = str_replace('/', '\\', $modelName);
        $path      = static::guessClassFileName($name);
        $dir       = dirname($path);

        $files = app('files');

        if (!is_dir($dir)) {
            $files->makeDirectory($dir, 0755, true);
        }

        if ($files->exists($path)) {
            abort(HttpResponse::HTTP_BAD_REQUEST, "Service [$name] already exists!");
        }

        $stub = $files->get($this->stub);

        $stub = $this->replaceClass($stub, $name)
            ->replaceTitle($stub)
            ->replaceModel($stub, $modelName)
            ->replaceNamespace($stub, $name)
            ->replaceSpace($stub);

        $files->put($path, $stub);
        $files->chmod($path, 0777);

        return $path;
    }

    public function preview($serviceName, $modelName): bool|string
    {
        $name      = str_replace('/', '\\', $serviceName);
        $modelName = str_replace('/', '\\', $modelName);
        $files     = app('files');
        $stub      = $files->get($this->stub);

        return $this->replaceClass($stub, $name)
            ->replaceTitle($stub)
            ->replaceModel($stub, $modelName)
            ->replaceNamespace($stub, $name)
            ->replaceSpace($stub);
    }

    public function replaceModel(&$stub, $name): static
    {
        $class = str_replace($this->getNamespace($name) . '\\', '', $name);

        $stub = str_replace(['{{ ModelName }}', '{{ UseModel }}'], [$class, $name], $stub);

        return $this;
    }
}
