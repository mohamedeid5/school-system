<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Seeder;
use App\Models\Blood;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
           BloodSeeder::class,
           NationalitiesSeeder::class,
           ReligionSeeder::class,
        ]);
    }
}
