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
        $tables = ['AdminHome','AdminPost','AdminTaxonomy','AdminTheme','AdminUser','Auth','Cvs','Employee','Job','Staff','Transaction'];
        $actions = ['viewAny','view','create','update','delete'];
        foreach ($tables as $table) {
            foreach ($actions as $action) {
                DB::table('roles')->insert(
                    [
                        "name" =>  $table.'_'.$action, 
                    ]
                );
            }
        }
    }
}