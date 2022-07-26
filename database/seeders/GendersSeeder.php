<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use DB;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();

        $genders = [

            [
                'en'=> 'Male',
                'ar'=> 'ذكر'
            ],
            [
                'en'=> 'Female',
                'ar'=> 'انثى'
            ],
            [
                'en'=> 'Other',
                'ar'=> 'غيرذلك'
            ],

        ];

        foreach ($genders as $gender) {
            Gender::create([
                'type' => $gender
            ]);
        }
    }
}
