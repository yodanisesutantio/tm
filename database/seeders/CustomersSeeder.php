<?php

namespace Database\Seeders;

use App\Models\M5D3140;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code'        => 'CUST-001',
                'name'        => 'PT Maju Bersama',
                'address'     => 'Jl. Sudirman No. 123',
                'province'    => 'DKI Jakarta',
                'city'        => 'Jakarta Selatan',
                'district'    => 'Kebayoran Baru',
                'subdistrict' => 'Senayan',
                'postal_code' => '12190',
            ],
            [
                'code'        => 'CUST-002',
                'name'        => 'CV Jaya Abadi',
                'address'     => 'Jl. Asia Afrika No. 45',
                'province'    => 'Jawa Barat',
                'city'        => 'Bandung',
                'district'    => 'Sumur Bandung',
                'subdistrict' => 'Braga',
                'postal_code' => '40111',
            ],
            [
                'code'        => 'CUST-003',
                'name'        => 'Toko Sejahtera',
                'address'     => 'Jl. Pemuda No. 88',
                'province'    => 'Jawa Tengah',
                'city'        => 'Semarang',
                'district'    => 'Semarang Tengah',
                'subdistrict' => 'Sekayu',
                'postal_code' => '50132',
            ],
            [
                'code'        => 'CUST-004',
                'name'        => 'PT Sinar Makmur',
                'address'     => 'Jl. Tunjungan No. 12',
                'province'    => 'Jawa Timur',
                'city'        => 'Surabaya',
                'district'    => 'Genting',
                'subdistrict' => 'Embong Kaliasin',
                'postal_code' => '60271',
            ],
            [
                'code'        => 'CUST-005',
                'name'        => 'UD Bintang Lima',
                'address'     => 'Jl. Raya Serpong No. 99',
                'province'    => 'Banten',
                'city'        => 'Tangerang Selatan',
                'district'    => 'Serpong',
                'subdistrict' => 'BSD City',
                'postal_code' => '15310',
            ],
        ];

        foreach ($data as $item) {
            M5D3140::updateOrCreate(
                ['code' => $item['code']],
                array_merge($item, ['uuid' => (string) Str::uuid()])
            );
        }
    }
}
