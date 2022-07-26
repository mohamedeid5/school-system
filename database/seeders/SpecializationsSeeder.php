<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();

        $specializations = [

            [
                'en'=> 'Since',
                'ar'=> 'علوم'
            ],
            [
                'en'=> 'English',
                'ar'=> 'انجليزي'
            ],
            [
                'en'=> 'Arabic',
                'ar'=> 'عربي'
            ],

        ];

        foreach ($specializations as $specialization) {
            Specialization::create([
                'name' => $specialization
            ]);
        }
    }
}
