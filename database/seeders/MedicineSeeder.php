<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['tablet', 'kapsul', 'sirup'];

        for ($i = 1; $i <= 20; $i++) {
            Medicine::create([
                'name' =>implode('', array_rand(array_flip(range('a', 'z')), 5)),
                'type' => $types[array_rand($types)],
                'price' => rand(1000, 50000),
                'stock' => rand(0, 50),
            ]);
        }
    }
}
