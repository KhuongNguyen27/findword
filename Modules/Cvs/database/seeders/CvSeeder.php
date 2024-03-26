<?php

namespace Modules\Cvs\database\seeders;

use Illuminate\Database\Seeder;
use DB;

class CvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            'image' => 'https://www.topcv.vn/images/cv/screenshots/thumbs/cv-template-thumbnails-v1.2/delicate_2_v2.png?v=1.0.6',
            'language' => '1',
            'file_cv' => 'https://www.topcv.vn/images/cv/screenshots/thumbs/cv-template-thumbnails-v1.2/delicate_2_v2.png?v=1.0.6',
            'status' => 1,
        ];
        $cvs = [
            ['name' => 'Tinh tế'],
            ['name' => 'Cao cấp'],
            ['name' => 'Senior'],
            ['name' => 'Chuyên gia'],
            ['name' => 'Basic 4'],
            ['name' => 'Basic 5'],
            ['name' => 'Hiện đại 6'],
            ['name' => 'Tiêu chuẩn'],
            ['name' => 'Dòng thời gian'],
            ['name' => 'Chuyên nghiệp 1'],
            ['name' => 'Ấn tượng'],
            ['name' => 'Thời đại'],
        ];

        foreach ($cvs as $cv) {
            DB::table('cvs')->insert(array_merge($cv,$data));
        }
    }
}