<?php

namespace Modules\Cvs\database\seeders;

use Illuminate\Database\Seeder;
use DB;
class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $styles = [
            [
                'name' => 'Đơn giản',
                'status' => 1,
            ],
            [
                'name' => 'Thanh lịch',
                'status' => 1,
            ],
            [
                'name' => 'Kinh nghiệm',
                'status' => 1,
            ],
            [
                'name' => 'Màu sắc',
                'status' => 1,
            ],
            [
                'name' => 'Sáng tạo',
                'status' => 1,
            ],
            [
                'name' => 'Chuyên nghiệp',
                'status' => 1,
            ],
            [
                'name' => 'Trang trọng',
                'status' => 1,
            ],
            [
                'name' => 'Hiện đại',
                'status' => 1,
            ],
            [
                'name' => 'ATS',
                'status' => 1,
            ],
            [
                'name' => '1 Trang',
                'status' => 1,
            ],
            [
                'name' => '2 Trang',
                'status' => 1,
            ],
            [
                'name' => 'Ấn tượng',
                'status' => 1,
            ],
            [
                'name' => 'Truyền thống',
                'status' => 1,
            ],
            [
                'name' => 'Công nghệ',
                'status' => 1,
            ],
            [
                'name' => 'Harvard',
                'status' => 1,
            ],
            [
                'name' => 'Không ảnh',
                'status' => 1,
            ],
            [
                'name' => 'Thương hiệu',
                'status' => 1,
            ],
            [
                'name' => 'Xã hội',
                'status' => 1,
            ],
        ];

        foreach ($styles as $style) {
            DB::table('styles')->insert($style);
        }
    }
}