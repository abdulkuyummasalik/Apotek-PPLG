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

        // for ($i = 1; $i <= 20; $i++) {
        //     Medicine::create([
        //         'name' => implode('', array_rand(array_flip(range('a', 'z')), 5)),
        //         'type' => $types[array_rand($types)],
        //         'price' => rand(1, 50) * 1000,
        //         'stock' => rand(0, 50),
        //     ]);
        // }

        Medicine::create([
            'name' => 'Bodrex',
            'type' => $types[array_rand($types)],
            'price' => 2000,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'Paracetamol',
            'type' => $types[array_rand($types)],
            'price' => 1500,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'Amoxicillin',
            'type' => $types[array_rand($types)],
            'price' => 5000,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'OBH Combi',
            'type' => $types[array_rand($types)],
            'price' => 8000,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'Betadine',
            'type' => $types[array_rand($types)],
            'price' => 7000,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'Antangin',
            'type' => $types[array_rand($types)],
            'price' => 3000,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'Panadol',
            'type' => $types[array_rand($types)],
            'price' => 2500,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'Mixagrip',
            'type' => $types[array_rand($types)],
            'price' => 2000,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'Laserin',
            'type' => $types[array_rand($types)],
            'price' => 4000,
            'stock' => rand(0, 50),
        ]);

        Medicine::create([
            'name' => 'Komix',
            'type' => $types[array_rand($types)],
            'price' => 3000,
            'stock' => rand(0, 50),
        ]);
    }
}
