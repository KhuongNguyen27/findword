<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareerSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $careers = [
            ['name' => 'Kỹ sư phần mềm', 'status' => 1, 'description' => 'Mô tả cho kỹ sư phần mềm', 'slug' => 'ky-su-phan-mem', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/code.png', 'parent_id' => 0, 'position' => 1],
            ['name' => 'Quản lý dự án', 'status' => 1, 'description' => 'Mô tả cho quản lý dự án', 'slug' => 'quan-ly-du-an', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/human_resource.png', 'parent_id' => 0, 'position' => 2],
            ['name' => 'Lập trình viên', 'status' => 1, 'description' => 'Mô tả cho lập trình viên', 'slug' => 'lap-trinh-vien', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/code.png', 'parent_id' => 0, 'position' => 3],
            ['name' => 'Thiết kế đồ họa', 'status' => 1, 'description' => 'Mô tả cho thiết kế đồ họa', 'slug' => 'thiet-ke-do-hoa', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/robot.png', 'parent_id' => 0, 'position' => 4],
            ['name' => 'Kế toán', 'status' => 1, 'description' => 'Mô tả cho kế toán', 'slug' => 'ke-toan', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/accountant.png', 'parent_id' => 0, 'position' => 5],
            ['name' => 'Nhân viên bán hàng', 'status' => 1, 'description' => 'Mô tả cho nhân viên bán hàng', 'slug' => 'nhan-vien-ban-hang', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/money_ticket.png', 'parent_id' => 0, 'position' => 6],
            ['name' => 'Marketing', 'status' => 1, 'description' => 'Mô tả cho marketing', 'slug' => 'marketing', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/marketing.png', 'parent_id' => 0, 'position' => 7],
            ['name' => 'Quản trị mạng', 'status' => 1, 'description' => 'Mô tả cho quản trị mạng', 'slug' => 'quan-tri-mang', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/star.png', 'parent_id' => 0, 'position' => 8],
            ['name' => 'Nhân viên văn phòng', 'status' => 1, 'description' => 'Mô tả cho nhân viên văn phòng', 'slug' => 'nhan-vien-van-phong', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/case.png', 'parent_id' => 0, 'position' => 9],
            ['name' => 'Giáo viên', 'status' => 1, 'description' => 'Mô tả cho giáo viên', 'slug' => 'giao-vien', 'image' => 'https://static.topcv.vn/v4/image/cv_builder/choose-cv-data/item/translator.png', 'parent_id' => 0, 'position' => 10],
        ];

        foreach ($careers as $career) {
            DB::table('careers')->insert($career);
        }
    }
}