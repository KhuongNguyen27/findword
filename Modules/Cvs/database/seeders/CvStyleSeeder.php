<?php

namespace Modules\Cvs\database\seeders;

use Illuminate\Database\Seeder;
use DB;
class CvStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <=5 ; $i++) { 
            for ($j=1; $j <=5 ; $j++) { 
                $data=[
                    'cv_id' => $i,
                    'style_id' => $j,
                ];
                DB::table('cv_style')->insert($data);
            }
        }
    }
}