<?php

namespace Slowlyo\OwlAdmin\Console;

use Slowlyo\OwlAdmin\Admin;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user
        {--username= : Login username}
        {--password= : Login password}
        {--name= : Display name}
        {--roles= : Role slugs or names, separated by comma}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user for admin panel.';

    /**
     * Execute the console command.
     */
    /**
     * 创建后台用户，支持交互和非交互两种方式，便于部署脚本初始化管理员。
     */
    public function handle(): int
    {
        $userModel = Admin::adminUserModel();
        $roleModel = Admin::adminRoleModel();

        $username = $this->option('username') ?: $this->ask('Please enter a username to login');

        if ($userModel::query()->where('username', $username)->exists()) {
            $this->error("User [{$username}] already exists.");

            return self::FAILURE;
        }

        $password = $this->option('password') ?: $this->secret('Please enter a password to login');

        if (blank($password)) {
            $this->error('Password can not be empty.');

            return self::FAILURE;
        }

        $name = $this->option('name') ?: $this->ask('Please enter a name to display');

        $roles = $roleModel::query()->get();

        if ($roles->isEmpty()) {
            $this->error('No roles available, please create roles first.');

            return self::FAILURE;
        }

        /** @var array $selected */
        $selected = $this->selectedRoles($roles);

        $roles = $roles->filter(function ($role) use ($selected) {
            return in_array($role->name, $selected) || in_array($role->slug, $selected);
        });

        if ($roles->isEmpty()) {
            $this->error('Selected roles not found.');

            return self::FAILURE;
        }

        $password = bcrypt($password);
        $user = new $userModel(compact('username', 'password', 'name'));

        $user->save();

        $user->roles()->attach($roles);

        $this->info("User [$name] created successfully.");

        return self::SUCCESS;
    }

    /**
     * 解析角色选项，非交互模式支持 role slug/name，交互模式沿用角色名称选择。
     */
    protected function selectedRoles($roles): array
    {
        if ($this->option('roles')) {
            // 命令行参数更适合脚本调用，按逗号拆分后去掉空值。
            return collect(explode(',', $this->option('roles')))->map(fn($role) => trim($role))->filter()->all();
        }

        return $this->choice('Please choose a role for the user', $roles->pluck('name')->toArray(), null, null, true);
    }
}
