<?php

namespace Database\Seeders;

use App\Models\M90CAF9;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'uuid'     => (string) Str::uuid(),
                'category' => 'Barang Jadi',
                'code'     => 'PRD-001',
                'name'     => 'Kopi Arabika 250g',
                'price'    => 75000.00,
                'stock'    => 50.00,
            ],
            [
                'uuid'     => (string) Str::uuid(),
                'category' => 'Barang Jadi',
                'code'     => 'PRD-002',
                'name'     => 'Teh Hijau Organic 100g',
                'price'    => 45000.00,
                'stock'    => 120.00,
            ],
            [
                'uuid'     => (string) Str::uuid(),
                'category' => 'Bahan Baku',
                'code'     => 'RAW-001',
                'name'     => 'Biji Kopi Mentah (Green Beans) 1kg',
                'price'    => 110000.00,
                'stock'    => 500.00,
            ],
            [
                'uuid'     => (string) Str::uuid(),
                'category' => 'Aset',
                'code'     => 'AST-001',
                'name'     => 'Mesin Espresso Commercial 2 Group',
                'price'    => 35000000.00,
                'stock'    => 2.00,
            ],
            [
                'uuid'     => (string) Str::uuid(),
                'category' => 'Material',
                'code'     => 'MAT-001',
                'name'     => 'Kemasan Standing Pouch 250g',
                'price'    => 1500.00,
                'stock'    => 1000.00,
            ],
        ];

        foreach ($products as $product) {
            M90CAF9::updateOrCreate(
                ['code' => $product['code']],
                $product
            );
        }
    }
}
