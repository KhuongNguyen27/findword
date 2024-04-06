<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'name' => 'Thường',
                'description' => 'mô tả gói khách hàng',
                'price' => 0,
            ],
            [
                'name' => 'Premium',
                'description' => 'mô tả gói khách hàng Premium',
                'price' => 200000,
            ],
            [
                'name' => 'Vip',
                'description' => 'mô tả gói khách hàng Vip',
                'price' => 500000,
            ]

        ];
        foreach ($datas as $data) {
            DB::table('accounts')->insert($data);
        }
    }
}