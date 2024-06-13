<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class DeleteUser extends Command
{
    protected $signature = 'user:delete {email}';
    protected $description = 'Удалить существующего пользователя';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (empty($user)) {
            $this->info("Пользователь с почтой $email не найден.");
            return;
        }

        $userName = $user->full_name;
        $user->delete();

        $this->info("Пользователь $userName успешно удалён.");
    }
}
