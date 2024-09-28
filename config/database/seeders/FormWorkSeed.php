<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormWorkSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formWorks = [
            ['name' => 'Hợp Đồng', 'status' => 1, 'description' => 'Mô tả cho Hợp Đồng', 'slug' => 'hop-dong', 'image' => 'image1.jpg', 'parent_id' => 0, 'position' => 1],
            ['name' => 'Chính Thức', 'status' => 1, 'description' => 'Mô tả cho Chính Thức', 'slug' => 'chinh-thuc', 'image' => 'image2.jpg', 'parent_id' => 0, 'position' => 2],
            ['name' => 'Thực Tập', 'status' => 1, 'description' => 'Mô tả cho Thực Tập', 'slug' => 'thuc-tap', 'image' => 'image3.jpg', 'parent_id' => 0, 'position' => 3],
        ];

        foreach ($formWorks as $formWork) {
            DB::table('form_works')->insert($formWork);
        }
    }
}