<?php

namespace Modules\Permission\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();
        $tables = ['user'];
        $actions = ['viewAny','view','create','update','delete', 'viewAnySystem','viewSystem','createSystem','updateSystem','deleteSystem', 'viewAnyPost','viewPost','createPost','updatePost','deletePost'];
        foreach ($tables as $table) {
            foreach ($actions as $action) {
                DB::table('roles')->insert(
                    [
                        "name" =>  $table.'_'.$action, 
                    ]
                );
            }
        }
        DB::table('roles')->insert(
            [
                "name" =>  'home_viewAny', 
            ]
        );
    }
}