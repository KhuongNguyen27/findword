<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Faker\Factory as Faker;

class CVseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $email = $faker->email;
            for ($j = 0; $j < 10; $j++) {
                $name = $faker->name;
                $soDienThoai = $faker->phoneNumber;
                $ngaySinh = $faker->date('Y-m-d');
                $gioiTinh = rand(1,3);
                $thanhPho = $faker->city;
                $diaChi = $faker->address;
                $chucVu = $faker->jobTitle;
                $capBac = rand(1,3);
                $loaiHinhLamViec = rand(1,3);
                $nganhNghe = $faker->jobTitle;
                $diaDiemLamViec = $faker->city;
                $mucLuong = $faker->numberBetween(1000, 5000);
                $mucTieuNgheNghiep = $faker->text;

                DB::table('user_cvs')->insert([
                    'cv_file' => $name,
                    'name' => $name,
                    'email' => $email,
                    'user_id' => $i,
                    'phone' => $soDienThoai,
                    'birthdate' => $ngaySinh,
                    'gender' => $gioiTinh,
                    'city' => $thanhPho,
                    'address' => $diaChi,
                    'desired_position' => $chucVu,
                    'desired_rank' => $capBac,
                    'employment_type' => $loaiHinhLamViec,
                    'industry' => $nganhNghe,
                    'desired_location' => $diaDiemLamViec,
                    'desired_salary' => $mucLuong,
                    'career_objective' => $mucTieuNgheNghiep,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}