<?php

namespace Database\Seeders;

use App\Models\Carrier;
use Illuminate\Database\Seeder;

class CarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carrier::query()->delete();

        $carriers = [
            [
                'name' => 'Giao Hàng Tiết Kiệm',
                'logo' => 'ghtk-logo.png',
                'code' => 'ghtk',
                'description' => 'Dịch vụ giao hàng tiết kiệm, phủ sóng toàn quốc và hỗ trợ COD.',
                'status' => true,
            ],
        ];

        foreach ($carriers as $carrier) {
            Carrier::create($carrier);
        }
    }
}
