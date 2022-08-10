<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{

    public $email = 'admin@admin.com';
    public $name = 'Admin';
    public $password = 'password';

    public function run()
    {
        AdminUser::query()
            ->where('email', $this->email)
            ->existsOr(function () {
                $user = AdminUser::query()->create([
                    'email' => $this->email,
                    'name' => $this->name,
                    'password' => bcrypt($this->password)
                ]);

                $user->assignRole('admin');
            });

        AdminUser::whereEmail($this->email)->update(['password' => $this->password]);
    }
}
