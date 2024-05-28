<?php

namespace Slowlyo\OwlAdmin\Support\CodeGenerator;

use Illuminate\Support\Str;

class ServiceGenerator extends BaseGenerator
{
    public function generate()
    {
        return $this->writeFile($this->model->service_name, 'Service');
    }

    public function preview()
    {
        return $this->assembly();
    }

    public function assembly()
    {
        $name           = $this->model->service_name;
        $class          = Str::of($name)->explode('/')->last();
        $modelClass     = str_replace('/', '\\', $this->model->model_name);
        $modelClassName = Str::of($modelClass)->explode('\\')->last();

        $content = '<?php' . PHP_EOL . PHP_EOL;
        $content .= 'namespace ' . $this->getNamespace($name) . ';' . PHP_EOL . PHP_EOL;
        $content .= "use {$modelClass};" . PHP_EOL;
        $content .= 'use Slowlyo\OwlAdmin\Services\AdminService;' . PHP_EOL . PHP_EOL;
        $content .= '/**' . PHP_EOL;
        $content .= ' * ' . $this->model->title . PHP_EOL;
        $content .= ' *' . PHP_EOL;
        $content .= " * @method {$modelClassName} getModel()" . PHP_EOL;
        $content .= " * @method {$modelClassName}|\Illuminate\Database\Query\Builder query()" . PHP_EOL;
        $content .= ' */' . PHP_EOL;
        $content .= "class {$class} extends AdminService" . PHP_EOL;
        $content .= '{' . PHP_EOL;
        $content .= "\tprotected string \$modelName = {$modelClassName}::class;" . PHP_EOL;
        $content .= '}';

        return $content;
    }
}
