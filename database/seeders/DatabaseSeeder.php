<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (! app()->environment(['local', 'testing'])) {
            return;
        }

        $this->createDemoUser('Admin Menu', 'admin@menu.test', User::ROLE_ADMIN);
        $this->createDemoUser('Pengunjung Menu', 'user@menu.test', User::ROLE_USER);
        $this->call(MenuSeeder::class);
    }

    private function createDemoUser(string $name, string $email, string $role): void
    {
        $password = config('menu_demo.'.$role.'_password');
        $token = config('menu_demo.'.$role.'_token');

        if (! is_string($password) || strlen($password) < 12) {
            $this->command?->warn('Akun '.$email.' memerlukan konfigurasi kata sandi minimal 12 karakter.');

            return;
        }

        $user = User::firstOrNew(['email' => $email]);

        if ($user->exists) {
            return;
        }

        $user->fill(['name' => $name, 'password' => $password]);
        $user->role = $role;
        $user->api_token = is_string($token) && strlen($token) >= 32 ? hash('sha256', $token) : null;
        $user->save();
    }
}
