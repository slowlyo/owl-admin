<?php

namespace Slowlyo\OwlAdmin\Tests\Unit;

use Illuminate\Support\Facades\File;
use RuntimeException;
use Slowlyo\OwlAdmin\Admin;
use Slowlyo\OwlAdmin\Controllers\DevTools\ApiController;
use Slowlyo\OwlAdmin\Exceptions\AdminException;
use Slowlyo\OwlAdmin\Support\Cores\Api;
use Slowlyo\OwlAdmin\Support\PathGuard;
use Slowlyo\OwlAdmin\Support\Zip;
use Slowlyo\OwlAdmin\Tests\TestCase;

class DevToolsPathTraversalTest extends TestCase
{
    private string $appPath;

    private string $extensionsRoot;

    /**
     * 为模板与扩展安装测试准备独立 app 与 extensions 目录。
     */
    protected function defineEnvironment($app): void
    {
        parent::defineEnvironment($app);

        $this->appPath        = sys_get_temp_dir() . '/owl_admin_app_' . uniqid();
        $this->extensionsRoot = sys_get_temp_dir() . '/owl_admin_ext_' . uniqid();

        File::makeDirectory($this->appPath . '/ApiTemplates', 0755, true);
        File::makeDirectory($this->extensionsRoot, 0755, true);

        $app->useAppPath($this->appPath);
        $app['config']->set('admin.extension.dir', $this->extensionsRoot);
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->appPath);
        File::deleteDirectory($this->extensionsRoot);

        parent::tearDown();
    }

    public function test_path_guard_rejects_malicious_composer_package_names(): void
    {
        $this->assertFalse(PathGuard::isValidComposerPackageName('../public'));
        $this->assertFalse(PathGuard::isValidComposerPackageName('vendor/../public'));
        $this->assertFalse(PathGuard::isValidComposerPackageName(''));
        $this->assertTrue(PathGuard::isValidComposerPackageName('acme/demo-extension'));
    }

    public function test_path_guard_rejects_traversal_outside_extensions_root(): void
    {
        $escaped = $this->extensionsRoot . '/../owl_escape_' . uniqid();

        $this->assertFalse(PathGuard::isPathInsideDirectory($escaped, $this->extensionsRoot));
    }

    public function test_api_template_file_path_rejects_path_traversal_class_name(): void
    {
        $this->assertSame('', Api::templateFilePath('../../public/fp_shell'));
        $this->assertSame('', Api::templateFilePath('Evil/Class'));
    }

    public function test_add_template_rejects_malicious_class_name(): void
    {
        $controller = app(ApiController::class);

        request()->replace([
            'template' => $this->buildTemplateSource('../../public/fp_shell'),
            'overlay'  => 1,
        ]);

        $this->expectException(AdminException::class);

        $controller->addTemplate();
    }

    public function test_add_template_writes_legitimate_template_under_api_templates(): void
    {
        $controller = app(ApiController::class);
        $className  = 'SafeDynamicApi';

        request()->replace([
            'template' => $this->buildTemplateSource($className),
            'overlay'  => 1,
        ]);

        $response = $controller->addTemplate();

        $this->assertSame(0, $response->getData(true)['status'] ?? null);

        $file = Api::templateFilePath($className);

        $this->assertFileExists($file);
        $this->assertTrue(PathGuard::isRealPathInsideDirectory($file, Api::path()));
    }

    public function test_extension_install_rejects_malicious_composer_name(): void
    {
        $zipPath = $this->createExtensionZip('../public');

        $manager = Admin::extension();

        try {
            $this->expectException(RuntimeException::class);
            $manager->extractZip($zipPath, true);
        } finally {
            @unlink($zipPath);
        }
    }

    public function test_extension_install_places_legitimate_package_under_extensions_root(): void
    {
        $packageName = 'demo/safe-extension';
        $zipPath     = $this->createExtensionZip($packageName);

        $manager = Admin::extension();

        try {
            $name = $manager->extractZip($zipPath, true);

            $this->assertSame($packageName, $name);

            $target = admin_extension_path($packageName);

            $this->assertDirectoryExists($target);
            $this->assertFileExists($target . '/composer.json');
            $this->assertTrue(PathGuard::isRealPathInsideDirectory($target, $this->extensionsRoot));
        } finally {
            @unlink($zipPath);
        }
    }

    /**
     * 构造符合 add_template 解析规则的模板源码。
     */
    private function buildTemplateSource(string $classShortName): string
    {
        return <<<PHP
<?php

namespace App\\ApiTemplates;

use Slowlyo\\OwlAdmin\\Support\\Apis\\AdminBaseApi;

class {$classShortName} extends AdminBaseApi
{
}
PHP;
    }

    /**
     * 生成满足扩展校验规则的最小 ZIP 包。
     */
    private function createExtensionZip(string $packageName): string
    {
        $sourceDir = sys_get_temp_dir() . '/owl_zip_src_' . uniqid();
        $wrapper   = $sourceDir . '/wrapper';
        $packageRoot = $wrapper . '/package-root';

        File::makeDirectory($packageRoot . '/src', 0755, true);

        File::put($packageRoot . '/composer.json', json_encode([
            'name'  => $packageName,
            'extra' => [
                'owl-admin' => 'Demo\\SafeExtensionServiceProvider',
            ],
        ], JSON_THROW_ON_ERROR));

        File::put($packageRoot . '/src/SafeExtensionServiceProvider.php', '<?php');

        $zipPath = sys_get_temp_dir() . '/owl_zip_' . uniqid() . '.zip';

        Zip::make($zipPath, $wrapper);

        File::deleteDirectory($sourceDir);

        return $zipPath;
    }
}
