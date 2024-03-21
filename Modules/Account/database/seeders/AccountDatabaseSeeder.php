<?php

namespace Modules\Account\database\seeders;

use Illuminate\Database\Seeder;

class AccountDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([DurationSeeder::class]);
        $this->call([AccountSeeder::class]);
        $this->call([UserAccountSeeder::class]);
        $this->call([AccountJobPackageSeeder::class]);
    }
}