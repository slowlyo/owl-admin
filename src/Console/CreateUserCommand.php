<?php

namespace Slowlyo\SlowAdmin\Console;

use Illuminate\Console\Command;
use Slowlyo\SlowAdmin\Models\AdminUser;
use Slowlyo\SlowAdmin\Models\AdminRole;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建admin用户';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->ask('Please enter a username to login');

        $password = bcrypt($this->secret('Please enter a password to login'));

        $name = $this->ask('Please enter a name to display');

        $roles = AdminRole::all();

        /** @var array $selected */
        $selected =
            $this->choice('Please choose a role for the user', $roles->pluck('name')->toArray(), null, null, true);

        $roles = $roles->filter(function ($role) use ($selected) {
            return in_array($role->name, $selected);
        });

        $user = new AdminUser(compact('username', 'password', 'name'));

        $user->save();

        $user->roles()->attach($roles);

        $this->info("User [$name] created successfully.");
    }
}
