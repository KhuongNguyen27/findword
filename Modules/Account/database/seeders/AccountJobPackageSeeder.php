<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountJobPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'account_id' => 1,  
                'job_package_id' => 5,   
                'amount' => 2  
            ],
            [
                'account_id' => 2,  
                'job_package_id' => 5,   
                'amount' => 5  
            ],
            [
                'account_id' => 2,  
                'job_package_id' => 4,   
                'amount' => 1  
            ],
            [
                'account_id' => 2,  
                'job_package_id' => 3,   
                'amount' => 1 
            ],
            [
                'account_id' => 3,  
                'job_package_id' => 5,   
                'amount' => 10
            ],
            [
                'account_id' => 3,  
                'job_package_id' => 4,   
                'amount' => 2
            ],
            [
                'account_id' => 3,  
                'job_package_id' => 3,   
                'amount' => 2
            ],
            [
                'account_id' => 3,  
                'job_package_id' => 2,   
                'amount' => 2
            ],
            [
                'account_id' => 3,  
                'job_package_id' => 1,   
                'amount' => 2
            ],
        ];
        DB::table('account_job_package')->insert($datas);
    }
}