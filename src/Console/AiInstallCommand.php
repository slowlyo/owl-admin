<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class AiInstallCommand extends Command
{
    protected $signature = 'admin:ai-install
                            {--force : Overwrite existing AI assistant files}
                            {--dry-run : Preview files without writing}';

    protected $description = 'Install OwlAdmin AI assistant files.';

    /**
     * @var Filesystem
     */
    protected Filesystem $files;

    /**
     * 注入文件系统工具，命令只负责复制包内 AI 资料到当前 Laravel 项目。
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * 安装 AI 编辑器资料，默认写入项目根目录 .agents，避免直接修改各编辑器配置。
     */
    public function handle(): int
    {
        if (!$this->files->isDirectory($this->sourcePath())) {
            // 包内资源缺失时继续复制没有意义，直接失败便于发布前发现打包问题。
            $this->error(admin_trans('admin.console.ai_source_missing', ['path' => $this->sourcePath()]));

            return self::FAILURE;
        }

        // 安装映射只有固定三类资源，逐项处理可以保持输出顺序稳定。
        foreach ($this->installMap() as $from => $to) {
            $this->installItem($from, $to);
        }

        if ($this->option('dry-run')) {
            // 预览模式只输出范围，不提示安装完成，避免误导自动化脚本。
            $this->info(admin_trans('admin.console.ai_dry_run_finished'));

            return self::SUCCESS;
        }

        $this->info(admin_trans('admin.console.ai_install_finished', ['path' => base_path('.agents')]));

        return self::SUCCESS;
    }

    /**
     * 获取包内 AI 资料目录，命令发布时所有源文件都从这里读取。
     */
    protected function sourcePath(?string $path = null): string
    {
        $base = dirname(__DIR__, 2) . '/resources/ai';

        return $path ? $base . '/' . ltrim($path, '/') : $base;
    }

    /**
     * 定义源文件到用户项目的复制关系，保持 .agents 作为唯一默认落点。
     */
    protected function installMap(): array
    {
        return [
            $this->sourcePath('skills')    => base_path('.agents/skills'),
            $this->sourcePath('adapters')  => base_path('.agents/adapters'),
            $this->sourcePath('README.md') => base_path('.agents/README.md'),
        ];
    }

    /**
     * 根据源类型分发复制逻辑，目录和单文件都保持同样的覆盖策略。
     */
    protected function installItem(string $from, string $to): void
    {
        if ($this->files->isDirectory($from)) {
            // 目录需要逐文件复制，才能在未开启 force 时保留用户已调整的单个规则文件。
            $this->installDirectory($from, $to);

            return;
        }

        if ($this->files->isFile($from)) {
            // 单文件只在目标不存在或显式 force 时写入。
            $this->installFile($from, $to);

            return;
        }

        // 源路径不存在说明包资源不完整，输出警告但继续检查其他资源。
        $this->warn(admin_trans('admin.console.ai_source_missing', ['path' => $from]));
    }

    /**
     * 复制目录下所有文件，保持子目录结构，便于 skills 和适配文件继续扩展。
     */
    protected function installDirectory(string $from, string $to): void
    {
        // allFiles 会递归返回文件，适合保持 skills 和 adapters 的目录层级。
        foreach ($this->files->allFiles($from) as $file) {
            $this->installFile($file->getPathname(), $to . '/' . $file->getRelativePathname());
        }
    }

    /**
     * 复制单个文件，非 force 模式下跳过已有文件，避免覆盖用户本地规则。
     */
    protected function installFile(string $from, string $to): void
    {
        if ($this->files->exists($to) && !$this->option('force')) {
            // 用户可能已经按项目调整过 AI 规则，默认跳过比覆盖更安全。
            $this->warn(admin_trans('admin.console.ai_file_exists', ['path' => $this->relativePath($to)]));

            return;
        }

        if ($this->option('dry-run')) {
            // dry-run 只展示最终目标，不创建目录或写文件。
            $this->line(admin_trans('admin.console.ai_will_copy', ['path' => $this->relativePath($to)]));

            return;
        }

        $this->files->ensureDirectoryExists(dirname($to));
        $this->files->copy($from, $to);

        $this->line('<info>' . admin_trans('admin.console.ai_file_installed') . '</info> ' . $this->relativePath($to));
    }

    /**
     * 将绝对路径压缩成相对项目路径，终端输出更适合复制检查。
     */
    protected function relativePath(string $path): string
    {
        return str_replace(base_path() . '/', '', $path);
    }
}
