<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPackageSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobPackages = [
            [
                'name' => 'Tin Vip',
                'status' => 1,
                'description' => 'Mô tả cho Tin Vip',
                'price' => 50000,
                'slug' => 'tin-vip',
                'image' => 'image1.jpg',
                'parent_id' => 0,
                'position' => 1
            ],
            [
                'name' => 'Tin Gấp',
                'status' => 1,
                'description' => 'Mô tả cho Tin Gấp',
                'price' => 20000,
                'slug' => 'tin-gap',
                'image' => 'image2.jpg',
                'parent_id' => 0,
                'position' => 2
            ],
            [
                'name' => 'Tin Ưu Tiên',
                'status' => 1,
                'description' => 'Mô tả cho Tin ưu tiên',
                'price' => 20000,
                'slug' => 'tin-uu-tien',
                'image' => 'image3.jpg',
                'parent_id' => 0,
                'position' => 3
            ],
            [
                'name' => 'Tin Hot',
                'status' => 1,
                'description' => 'Mô tả cho Tin Hot',
                'price' => 10000, 'slug' => 'tin-hot',
                'image' => 'image4.jpg',
                'parent_id' => 0,
                'position' => 4
            ],
            [
                'name' => 'Tin Thường',
                'status' => 1,
                'description' => 'Mô tả cho Tin Thường',
                'price' => 5000, 'slug' => 'tin-thuong',
                'image' => 'image1.jpg',
                'parent_id' => 0,
                'position' => 5
            ],
        ];

        foreach ($jobPackages as $jobPackage) {
            DB::table('job_packages')->insert($jobPackage);
        }
    }
}