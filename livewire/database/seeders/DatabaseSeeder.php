<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin KaumJaya',
            'email' => 'kaumjaya123@gmail.com',
            'noWa'  => 81234567891,
            'level'  => '1',
            'password' => bcrypt('kaum_jaya123')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Johan Toni Wijaya',
            'email' => 'johantoni91@gmail.com',
            'noWa'  => 89671022623,
            'password' => bcrypt('B6345PME')
        ]);

        // \App\Models\Product::factory(15)->create();
        \App\Models\Product::factory()->create([
            'produk' => 'Martabak Telor',
            'harga'  => '2500',
            'status' => "Tersedia"
        ]);
        \App\Models\Product::factory()->create([
            'produk' => 'Telor Puyuh',
            'harga'  => '4000',
            'status' => "Tersedia"
        ]);
        \App\Models\Product::factory()->create([
            'produk' => 'Comro',
            'harga'  => '2500',
            'status' => "Tersedia"
        ]);
        \App\Models\Product::factory()->create([
            'produk' => 'Uli Goreng',
            'harga'  => '2500',
            'status' => "Tersedia"
        ]);
        \App\Models\Product::factory()->create([
            'produk' => 'Rengginang',
            'harga'  => '3000',
            'status' => "Tersedia"
        ]);
        \App\Models\Product::factory()->create([
            'produk' => 'Bala-bala',
            'harga'  => '2000',
            'status' => "Tersedia"
        ]);
        \App\Models\Product::factory()->create([
            'produk' => 'Nasi Uduk',
            'harga'  => '8000',
            'status' => "Tersedia"
        ]);
        \App\Models\Product::factory()->create([
            'produk' => 'Bongko Oncom',
            'harga'  => '3000',
            'status' => "Tersedia"
        ]);
        \App\Models\Product::factory()->create([
            'produk' => 'Bongko Sayur',
            'harga'  => '3000',
            'status' => "Tersedia"
        ]);
    }
}
