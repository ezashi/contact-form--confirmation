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

        // ユーザーデータを作成
        \App\Models\User::factory(3)->create();

        //問い合わせデータを作成
        $this->call(ContactSeeder::class);
    }
}
