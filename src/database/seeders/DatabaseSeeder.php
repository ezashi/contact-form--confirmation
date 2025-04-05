<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);

        // ユーザーデータとコンタクトデータを作成
        \App\Models\User::factory(35)->create();
        $this->call(ContactSeeder::class);
    }
}
