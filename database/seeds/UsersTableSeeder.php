<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'Adminov',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
            'username' => 'sergey',
            'first_name' => 'Sergey',
            'last_name' => 'Brin',
            'email' => 'brin@gmail.com',
            'password' => bcrypt('123456'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
            'username' => 'larry',
            'first_name' => 'Larry',
            'last_name' => 'Page',
            'email' => 'lary@gmail.com',
            'password' => bcrypt('123456'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('users')->insert([
            'username' => 'elon',
            'first_name' => 'Elon',
            'last_name' => 'Musk',
            'email' => 'elon@mail.com',
            'password' => bcrypt('123456'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
