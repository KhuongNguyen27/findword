<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            ['name' => 'Trung học', 'status' => 1, 'description' => 'Mô tả cho Trung học', 'slug' => 'trung-hoc', 'image' => 'image1.jpg', 'parent_id' => 0, 'position' => 1],
            ['name' => 'Cao đẳng', 'status' => 1, 'description' => 'Mô tả cho Cao đẳng', 'slug' => 'cao-dang', 'image' => 'image2.jpg', 'parent_id' => 0, 'position' => 2],
            ['name' => 'Đại học', 'status' => 1, 'description' => 'Mô tả cho Đại học', 'slug' => 'dai-hoc', 'image' => 'image3.jpg', 'parent_id' => 0, 'position' => 3],
            ['name' => 'Thạc sĩ', 'status' => 1, 'description' => 'Mô tả cho Thạc sĩ', 'slug' => 'thac-si', 'image' => 'image4.jpg', 'parent_id' => 0, 'position' => 4],
            ['name' => 'Tiến sĩ', 'status' => 1, 'description' => 'Mô tả cho Tiến sĩ', 'slug' => 'tien-si', 'image' => 'image5.jpg', 'parent_id' => 0, 'position' => 5],
        ];

        foreach ($ranks as $rank) {
            DB::table('ranks')->insert($rank);
        }
    }
}
