<?php

namespace Modules\Cvs\database\seeders;

use Illuminate\Database\Seeder;

class CvsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            StyleSeeder::class,
            CvSeeder::class,
            CvStyleSeeder::class,
            CvCareerSeeder::class,
        ]);
    }
}