<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => '管理者1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => '管理者2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => '管理者3',
            'email' => 'admin3@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
