<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WageSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wages = [
            ['name' => '5 triệu', 'status' => 1, 'description' => 'Mô tả cho mức lương 5 triệu', 'slug' => '5-trieu', 'image' => 'image1.jpg', 'parent_id' => 0, 'position' => 0],
            ['name' => '10 triệu', 'status' => 1, 'description' => 'Mô tả cho mức lương 10 triệu', 'slug' => '10-trieu', 'image' => 'image2.jpg', 'parent_id' => 0, 'position' => 0],
            ['name' => '15 triệu', 'status' => 1, 'description' => 'Mô tả cho mức lương 15 triệu', 'slug' => '15-trieu', 'image' => 'image3.jpg', 'parent_id' => 0, 'position' => 0],
            ['name' => '20 triệu', 'status' => 1, 'description' => 'Mô tả cho mức lương 20 triệu', 'slug' => '20-trieu', 'image' => 'image4.jpg', 'parent_id' => 0, 'position' => 0],
            ['name' => '25 triệu', 'status' => 1, 'description' => 'Mô tả cho mức lương 25 triệu', 'slug' => '25-trieu', 'image' => 'image5.jpg', 'parent_id' => 0, 'position' => 0],
        ];

        foreach ($wages as $wage) {
            DB::table('wages')->insert($wage);
        }
    }
}
