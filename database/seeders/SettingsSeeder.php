<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'school_name', 'value' => 'Mohamed Eid School'],
            ['key' => 'current_season', 'value' => '2021-2022'],
            ['key' => 'school_title', 'value' => 'ME'],
            ['key' => 'phone', 'value' => '010'],
            ['key' => 'address', 'value' => 'aga'],
            ['key' => 'logo', 'value' => 'logo'],
            ['key' => 'school_email', 'value' => 'email'],
            ['key' => 'end_first_term', 'value' => 'term'],
            ['key' => 'end_second_term', 'value' => 'term'],
        ];

        DB::table('settings')->insert($data);

    }
}
