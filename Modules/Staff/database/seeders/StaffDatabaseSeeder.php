<?php

namespace Modules\Staff\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call([
            UserCvSeeder::class,
            // CvsExampleSeeder::class,
            UserStaffSeeder::class,
            UserExperiencesSeeder::class,
            UserEducationSeeder::class,
            UserSkillSeeder::class,
            UserJobFavoriteSeeder::class,
            StaffSeeder::class,
        ]);
    }
}