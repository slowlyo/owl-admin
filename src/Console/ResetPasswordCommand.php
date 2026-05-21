<?php

namespace Slowlyo\OwlAdmin\Console;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Console\Command;

class ResetPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-password
        {--username= : Username}
        {--password= : New password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset a user\'s password for admin panel.';

    /**
     * Execute the console command.
     */
    /**
     * 重置后台用户密码，支持非交互参数，便于容器或 CI 环境修复账号。
     */
    public function handle(): int
    {
        $users = Admin::adminUserModel()::query()->get();
        $user = null;

        while (!$user) {
            $username = $this->option('username') ?: $this->askWithCompletion(admin_trans('admin.console.reset_password_username'), $users->pluck('username')->toArray());
            $user = $users->first(fn($user) => $user->username == $username);

            if (!$user && $this->option('username')) {
                // 非交互模式不能反复询问，用户名错误时直接失败。
                $this->error(admin_trans('admin.console.user_not_exists'));

                return self::FAILURE;
            }

            if (!$user) {
                $this->error(admin_trans('admin.console.user_not_exists'));
            }
        }

        $password = $this->option('password');

        while (!$password) {
            $password = $this->secret(admin_trans('admin.console.reset_password_password'));

            if ($password !== $this->secret(admin_trans('admin.console.reset_password_confirm'))) {
                // 交互模式要求二次确认，避免误输后直接覆盖密码。
                $this->error(admin_trans('admin.console.password_not_match'));
                $password = null;
            }
        }

        if (blank($password)) {
            $this->error(admin_trans('admin.console.password_empty'));

            return self::FAILURE;
        }

        $user->password = bcrypt($password);

        $user->save();

        $this->info(admin_trans('admin.console.reset_password_success'));

        return self::SUCCESS;
    }
}
