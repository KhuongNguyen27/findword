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
        DB::table('user_account')->insert([
            'user_id' => 1,
            'account_id' => 3,
            'duration_id' => 2,
            'register_date' => date('d-m-Y'),
            'is_current' => 1
        ]);
    }
}