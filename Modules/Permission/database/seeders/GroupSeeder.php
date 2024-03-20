<?php

namespace Modules\Permission\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
           ['name'=>'Người phát triển'],
           ['name'=>'Quản trị viên'],
           ['name'=>'Quản lý viên'],
           ['name'=>'Nhân viên '],
           ['name'=>'Người dùng tuyển dụng'],
           ['name'=>'Người dùng ứng tuyển'],
        ];
        DB::table('groups')->insert($data);
    }
}