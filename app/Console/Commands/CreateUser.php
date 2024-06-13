<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'user:create {last_name} {first_name} {patronymic} {email} {password}';
    protected $description = 'Создать нового пользователя c правами администратора. Минимальная длина пароля: 8 символов.';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $firstName = $this->argument('first_name');
        $lastName = $this->argument('last_name');
        $patronymic = $this->argument('patronymic');
        $email = $this->argument('email');
        $password = $this->argument('password');

        if (User::getUserByEmail($email)) {
            $this->info('Пользователь с такой почтой уже зарегистрирован.');
            return;
        }

        $adminRole = Role::where('name', 'Администратор')->first();
        if (!$adminRole) {
            $this->info('В базе данных не найдена роль администратора.');
            return;
        }

        $user = User::createUser([
            'email' => $email,
            'password' => $password,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'patronymic' => $patronymic,
            'role_id' => $adminRole->id,
        ]);

        $this->info("Пользователь $lastName $firstName $patronymic ($email) успешно создан.");
    }
}
