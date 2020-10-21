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
        \App\Models\User::create([
            'name' => 'test1',
            'password' => bcrypt('12345678'),
            'email' => 'test@test.com',
            'email_verified_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
