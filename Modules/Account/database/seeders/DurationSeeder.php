<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "name" => "1 tháng", 
                "number_date" => 30
            ], 
            [
                "name" => "3 tháng", 
                "number_date" => 90
            ],
            [
                "name" => "6 tháng", 
                "number_date" => 180
            ],
            [
                "name" => "12 tháng", 
                "number_date" => 365
            ],
            [
                "name" => "24 tháng", 
                "number_date" => 730
            ]
        ];
        foreach ($datas as $data) {
            DB::table('durations')->insert($data);
        }
    }
}