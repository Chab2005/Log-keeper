<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DevUserSeeder extends Seeder
{
    /**
     * Seed a fixed local development user.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['id' => 80085],
            [
                'name' => 'dev',
                'username' => 'dev',
                'email' => 'dev@devmail.com',
                'password' => 'dev',
            ],
        );
    }
}
