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
    protected $signature = 'admin:reset-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset a user\'s password for admin panel.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = Admin::adminUserModel()::query()->all();

        askForUserName:
        $username = $this->askWithCompletion('Please enter a username who needs to reset his password', $users->pluck('username')->toArray());

        $user = $users->first(fn($user) => $user->username == $username);

        if (is_null($user)) {
            $this->error('The user you entered is not exists');
            goto askForUserName;
        }

        enterPassword:
        $password = $this->secret('Please enter a password');

        if ($password !== $this->secret('Please confirm the password')) {
            $this->error('The passwords entered twice do not match, please re-enter');
            goto enterPassword;
        }

        $user->password = bcrypt($password);

        $user->save();

        $this->info('User password reset successfully.');
    }
}
