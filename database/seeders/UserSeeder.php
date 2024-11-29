<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'moderator',
            'email' => 'moder@mail.ru',
            'password' => Hash::make('123456'),
            'role' => 'moderator',
        ]);
        User::create([
            'name' => 'max',
            'email' => 'max@mail.ru',
            'password' => Hash::make('123456'),
            'role' => 'moderator',
        ]);

        User::factory(9)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('password'),
        // ]);
    }
}
