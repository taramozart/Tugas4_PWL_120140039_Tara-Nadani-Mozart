<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public $data = [
            [
                'name' => 'Rendang',
                'type' => 'Masakan Padang',
                'ingredient' => 'Daging',
                'prize' => 35000
            ],
            [
                'name' => 'Rawon',
                'type' => 'Masakan Jawa Timur',
                'ingredient' => 'Daging',
                'prize' => 30000
            ],
            [
                'name' => 'Teokbokki',
                'type' => 'Masakan Korea',
                'ingredient' => 'Tepung Beras',
                'prize' => 30000
            ],
            [
                'name' => 'Nasi Kebuli',
                'type' => 'Masakan Timur Tengah',
                'ingredient' => 'Nasi dan Daging',
                'prize' => 45000
            ],
            [
                'name' => 'Dimsum',
                'type' => 'Masakan Chinese',
                'ingredient' => 'Daging dan Tepung',
                'prize' => 25000
            ],
            [
                'name' => 'Ayam Betutu',
                'type' => 'Masakan Bali',
                'ingredient' => 'Ayam',
                'prize' => 40000
            ],
            [
                'name' => 'Sate Madura',
                'type' => 'Masakan Madura',
                'ingredient' => 'Daging ayam / sapi',
                'prize' => 30000
            ],
            [
                'name' => 'Kerak Telor',
                'type' => 'Masakan Betawi',
                'ingredient' => 'Telor',
                'prize' => 10000
            ],
            [
                'name' => 'Nasi Uduk',
                'type' => 'Masakan Jawa',
                'ingredient' => 'Nasi',
                'prize' => 10000
            ],
            [
                'name' => 'Seblak',
                'type' => 'Masakan Sunda',
                'ingredient' => 'Kerupuk',
                'prize' => 15000
            ]
    ];
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin123'),
        // ]);

        foreach ($this -> data as $item) {
            \App\Models\Food::factory()->create($item);
        }

    }
}
