<?php

namespace Modules\Permission\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <= 5; $i++) { 
            DB::table('group_role')->insert(
                [
                    "group_id" => 1, 
                    "role_id" => $i 
                ]
            );
        }
        DB::table('users')->update(['group_id' => 6]);
        DB::table('users')->whereId(1)->update(['group_id' => 1]);
    }
}