<?php

namespace Modules\Staff\database\seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CvsExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 0,
                'cv_file' => 'Fresher',
                'name' => 'Staff1',
                'email' => 'email@gmail.com',
                'phone' => '0000000000',
                'birthdate' => '1990-01-01',
                'gender' => 'Nam',
                'city' => 'Thành phố Hồ Chí Minh',
                'address' => '123 Đường ABC, Quận XYZ',
                'outstanding_achievements' => 'Đã đạt được nhiều giải thưởng trong lĩnh vực của mình.',
                'desired_position' => 'Chuyên viên Phát triển Web',
                'rank_id' => 1,
                'form_work_id' => 1,
                'career_id' => 1,
                'desired_location' => 'Thành phố Hồ Chí Minh',
                'wage_id' => 1,
                'career_objective' => 'Mục tiêu nghề nghiệp của tôi là phát triển kỹ năng và kiến thức trong lĩnh vực phát triển web, đồng thời đóng góp tích cực cho sự thành công của dự án.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 0,
                'cv_file' => 'Iunior',
                'name' => 'Staff2',
                'email' => 'email@gmail.com',
                'phone' => '0000000000',
                'birthdate' => '1991-02-02',
                'gender' => 'Nữ',
                'city' => 'Hà Nội',
                'address' => '456 Đường XYZ, Quận ABC',
                'outstanding_achievements' => 'Có kinh nghiệm thực tế trong các dự án lớn.',
                'desired_position' => 'Chuyên viên Phát triển Phần mềm',
                'rank_id' => 1,
                'form_work_id' => 1,
                'career_id' => 1,
                'desired_location' => 'Hà Nội',
                'wage_id' => 1,
                'career_objective' => 'Tôi muốn phát triển sự nghiệp trong lĩnh vực phần mềm, với mục tiêu trở thành một chuyên gia phát triển.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 0,
                'cv_file' => 'Intern',
                'name' => 'Staff3',
                'email' => 'email@gmail.com',
                'phone' => '0000000000',
                'birthdate' => '1992-03-03',
                'gender' => 'Khác',
                'city' => 'Đà Nẵng',
                'address' => '789 Đường MNO, Quận PQR',
                'outstanding_achievements' => 'Nắm vững kiến thức và kỹ năng cần thiết cho ngành công nghiệp IT.',
                'desired_position' => 'Chuyên viên Phân tích Dữ liệu',
                'rank_id' => 1,
                'form_work_id' => 1,
                'career_id' => 1,
                'desired_location' => 'Đà Nẵng',
                'wage_id' => 1,
                'career_objective' => 'Mục tiêu của tôi là học hỏi và phát triển trong môi trường làm việc thực tế, đồng thời áp dụng những kiến thức đã học trong các dự án thực tế.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('cvs_example')->insert($data);
    }
}