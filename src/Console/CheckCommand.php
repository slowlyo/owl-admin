<?php

namespace Slowlyo\OwlAdmin\Console;

use Illuminate\Console\Command;
use Slowlyo\OwlAdmin\Support\Composer;

class CheckCommand extends Command
{
    protected $signature = 'admin:check {--zh}';

    protected $description = 'Check the environment';

    protected bool $zh;
    protected bool $hasError = false;

    public function handle(): void
    {
        $this->zh = $this->option('zh');

        $this->checkAppKey();
        $this->checkLang();
        $this->checkDb();
        $this->checkVersion();

        if (!$this->hasError) {
            $this->echoSucc('环境正常', 'The environment is normal.');
        }
    }

    public function checkAppKey()
    {
        if (blank(config('app.key'))) {
            $this->echoWarn('APP_KEY 没有设置', 'The APP_KEY is not set.');
        }
    }

    public function checkLang()
    {
        if (trans('admin.username') === 'admin.username') {
            $this->echoWarn(
                '多语言未生效, 请检查资源是否已发布 / lang 目录是否存在且有权访问',
                'The language is not enabled, please check if the resource has been published / lang directory exists and has permission to access'
            );
        }
    }

    public function checkDb()
    {
        try {
            $this->callSilently('migrate:status');
        } catch (\Exception $e) {
            $this->echoWarn('数据库未配置或配置错误', 'The database is not configured or configured incorrectly');
        }
    }

    public function checkVersion()
    {
        try {
            $latest = file_get_contents('https://gitee.com/api/v5/repos/slowlyo/owl-admin/tags?sort=updated&direction=desc&page=1&per_page=1');
            $latest = json_decode($latest, true)[0]['name'];

            $now = Composer::getVersion('slowlyo/owl-admin');

            if ($now !== $latest) {
                $this->echoWarn(
                    "OwlAdmin 最新版本 [{$latest}]，当前版本 [{$now}]，请及时更新",
                    'OwlAdmin latest version {$latest}, current version {$now}, please update it immediately'
                );
            }
        } catch (\Throwable $e) {
        }
    }

    protected function echoWarn($zh, $en)
    {
        $this->warn('>> ' . ($this->zh ? $zh : $en));
        $this->newLine();
        $this->hasError = true;
    }

    protected function echoSucc($zh, $en)
    {
        $this->info('>> ' . ($this->zh ? $zh : $en));
        $this->newLine();
    }
}
