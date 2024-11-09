<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Khoyum Masalik',
            'email' => 'apotek_admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Muhammad Anwar',
            'email' => 'cashier@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'cashier'
        ]);

        $faker = Faker::create();

        for ($i = 0; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 'cashier'
            ]);
        }
    }
}
