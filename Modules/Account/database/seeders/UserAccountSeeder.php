<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expiration_date = new \DateTime();
        $expiration_date->add(new \DateInterval('P30D'));
        DB::table('user_account')->insert([
            'user_id' => 1,
            'account_id' => 3,
            'duration_id' => 2,
            'register_date' => date('Y-m-d H:i:s'),
            'expiration_date' => $expiration_date,
            'is_current' => 1
        ]);
    }
}