<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['name' => 'Nhân viên', 'status' => 1, 'description' => 'Mô tả cho Nhân viên', 'slug' => 'nhan-vien', 'image' => 'image1.jpg', 'parent_id' => 0, 'position' => 1],
            ['name' => 'Trưởng nhóm', 'status' => 1, 'description' => 'Mô tả cho Trưởng nhóm', 'slug' => 'truong-nhom', 'image' => 'image2.jpg', 'parent_id' => 0, 'position' => 2],
            ['name' => 'Quản lý', 'status' => 1, 'description' => 'Mô tả cho Quản lý', 'slug' => 'quan-ly', 'image' => 'image3.jpg', 'parent_id' => 0, 'position' => 3],
            ['name' => 'Giám đốc', 'status' => 1, 'description' => 'Mô tả cho Giám đốc', 'slug' => 'giam-doc', 'image' => 'image4.jpg', 'parent_id' => 0, 'position' => 4],
            ['name' => 'Chủ tịch', 'status' => 1, 'description' => 'Mô tả cho Chủ tịch', 'slug' => 'chu-tich', 'image' => 'image5.jpg', 'parent_id' => 0, 'position' => 5],
        ];

        foreach ($levels as $level) {
            DB::table('levels')->insert($level);
        }
    }
}
