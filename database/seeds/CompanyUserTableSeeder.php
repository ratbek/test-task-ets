<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('company_user')->insert([
            'company_id' => 1,
            'user_id' => 2,
        ]);

        DB::table('company_user')->insert([
            'company_id' => 1,
            'user_id' => 3,
        ]);

        DB::table('company_user')->insert([
            'company_id' => 2,
            'user_id' => 4,
        ]);

        DB::table('company_user')->insert([
            'company_id' => 3,
            'user_id' => 4,
        ]);
    }
}
