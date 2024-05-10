<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Slowlyo\OwlAdmin\Controllers\AdminController;

class IdeHelperCommand extends Command
{
    protected $signature = 'admin:ide-helper';

    protected $description = 'Generate IDE helper file';

    public function handle(): void
    {
        $this->initMetaFile();

        $this->handleHelper();

        $this->pushMeta('}', 0);

        $this->info('Done.');
    }

    public function initMetaFile()
    {
        $text = <<<EOF
<?php

namespace PHPSTORM_META {

EOF;

        file_put_contents(config('admin.directory') . '/.phpstorm.meta.php', $text);
    }

    public function pushMeta($text, $tab = 1)
    {
        $tabs = str_repeat("\t", $tab);

        file_put_contents(config('admin.directory') . '/.phpstorm.meta.php', $tabs . $text . PHP_EOL, FILE_APPEND);
    }

    public function pushHelper($text)
    {
        file_put_contents(base_path('/_admin_ide_helper.php'), $text . PHP_EOL, FILE_APPEND);
    }

    public function handleHelper()
    {
        $text = <<<EOF
<?php

/** @noinspection all */
EOF;

        file_put_contents(base_path('/_admin_ide_helper.php'), $text);

        collect(Route::getRoutes())
            ->map(function ($route) {
                try {
                    $action = $route->getActionName();

                    if ($action == 'Closure') {
                        return null;
                    }

                    return explode('@', $action)[0];
                } catch (\Exception $e) {
                    return null;
                }
            })
            ->filter()
            ->unique()
            ->filter(fn($i) => $this->isSubclassOf($i, AdminController::class))
            ->values()
            ->filter(fn($i) => property_exists(new $i, 'serviceName'))
            ->map(function ($class) {
                $serviceName = $this->getProperty($class, 'serviceName');

                return [
                    'raw'              => $class,
                    'class'            => Str::afterLast($class, '\\'),
                    'namespace'        => Str::beforeLast($class, '\\'),
                    'serviceRaw'       => $serviceName,
                    'service'          => Str::afterLast($serviceName, '\\'),
                    'serviceNamespace' => Str::beforeLast($serviceName, '\\'),
                ];
            })
            ->groupBy('namespace')
            ->map(function ($item) {
                // region Handle Controller
                $namespace = $item->first()['namespace'];
                $content   = $item->map(function ($value) {
                    $class   = $value['class'];
                    $service = $value['serviceRaw'];

                    $this->pushMeta("expectedArguments(\\{$value['raw']}::createButton(), 1, 'xs', 'sm', 'md', 'lg', 'xl', 'full');");
                    $this->pushMeta("expectedArguments(\\{$value['raw']}::rowEditButton(), 1, 'xs', 'sm', 'md', 'lg', 'xl', 'full');");
                    $this->pushMeta("expectedArguments(\\{$value['raw']}::rowShowButton(), 1, 'xs', 'sm', 'md', 'lg', 'xl', 'full');");
                    $this->pushMeta("expectedArguments(\\{$value['raw']}::rowActions(), 1, 'xs', 'sm', 'md', 'lg', 'xl', 'full');");

                    return <<<PHP

    /** @property \\$service \$service */
    class $class {}
PHP;
                })->implode(PHP_EOL);

                $text = <<<PHP

namespace $namespace {
$content
}
PHP;

                $this->pushHelper($text);

                return $item;
                // endregion
            })
            ->flatten(1)
            ->groupBy('serviceNamespace')
            ->map(function ($item) {
                // region Handle Service
                $namespace = $item->first()['serviceNamespace'];
                $content   = $item->unique('serviceRaw')->map(function ($value) {
                    $class = $value['service'];
                    $model = $this->getProperty($value['serviceRaw'], 'modelName');

                    return <<<PHP

    /**
     * @method \\$model getModel()
     * @method \\$model|\\Illuminate\\Database\\Eloquent\\Builder query()
     * @mixin {$class}_C
     */
    class $class {}

    /**
     * @method void addRelations(\\$model \$query, string \$scene)
     * @method void sortable(\\$model \$query)
     * @method void searchable(\\$model \$query)
     * @method void saved(\\$model \$query)
     * @method \\$model|\\Illuminate\\Database\\Eloquent\\Builder listQuery()
     * @method \\$model getDetail(\$id)
     * @method \\$model getEditData(\$id)
     */
    class {$class}_C extends $class {}
PHP;
                })->implode(PHP_EOL);

                $text = <<<PHP

namespace $namespace {
$content
}
PHP;

                $this->pushHelper($text);

                return $item;
                // endregion
            });
    }

    public function isSubclassOf($class, $interface)
    {
        try {
            $reflection = new \ReflectionClass($class);

            return $reflection->isSubclassOf($interface);
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function getProperty($class, $property)
    {
        $refProperty = (new \ReflectionClass($class))->getProperty($property);

        $refProperty->setAccessible(true);

        return $refProperty->getValue(app($class));
    }
}
