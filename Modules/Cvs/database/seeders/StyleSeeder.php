<?php

namespace Modules\Cvs\database\seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

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
                'slug' => Str::slug('Đơn giản'),
                'status' => 1,
            ],
            [
                'name' => 'Thanh lịch',
                'slug' => Str::slug('Thanh lịch'),
                'status' => 1,
            ],
            [
                'name' => 'Kinh nghiệm',
                'slug' => Str::slug('Kinh nghiệm'),
                'status' => 1,
            ],
            [
                'name' => 'Màu sắc',
                'slug' => Str::slug('Màu sắc'),
                'status' => 1,
            ],
            [
                'name' => 'Sáng tạo',
                'slug' => Str::slug('Sáng tạo'),
                'status' => 1,
            ],
            [
                'name' => 'Chuyên nghiệp',
                'slug' => Str::slug('Chuyên nghiệp'),
                'status' => 1,
            ],
            [
                'name' => 'Trang trọng',
                'slug' => Str::slug('Trang trọng'),
                'status' => 1,
            ],
            [
                'name' => 'Hiện đại',
                'slug' => Str::slug('Hiện đại'),
                'status' => 1,
            ],
            [
                'name' => 'ATS',
                'slug' => Str::slug('ATS'),
                'status' => 1,
            ],
            [
                'name' => '1 Trang',
                'slug' => Str::slug('1 Trang'),
                'status' => 1,
            ],
            [
                'name' => '2 Trang',
                'slug' => Str::slug('2 Trang'),
                'status' => 1,
            ],
            [
                'name' => 'Ấn tượng',
                'slug' => Str::slug('Ấn tượng'),
                'status' => 1,
            ],
            [
                'name' => 'Truyền thống',
                'slug' => Str::slug('Truyền thống'),
                'status' => 1,
            ],
            [
                'name' => 'Công nghệ',
                'slug' => Str::slug('Công nghệ'),
                'status' => 1,
            ],
            [
                'name' => 'Harvard',
                'slug' => Str::slug('Harvard',),
                'status' => 1,
            ],
            [
                'name' => 'Không ảnh',
                'slug' => Str::slug('Không ảnh'),
                'status' => 1,
            ],
            [
                'name' => 'Thương hiệu',
                'slug' => Str::slug('Thương hiệu'),
                'status' => 1,
            ],
            [
                'name' => 'Xã hội',
                'slug'=> Str::slug('Xã hội'),     
                'status' => 1,
            ],
        ];

        foreach ($styles as $style) {
            DB::table('styles')->insert($style);
        }
    }
}