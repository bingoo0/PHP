<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
    	$password = bcrypt('123456');
    	$date = date('Y-m-d H:i:s');

        DB::table('users')->insert([
        	'name' => 'Admin',
        	'email' => 'admin@admin.com',
        	'isAdmin' => true,
        	'password' => $password,
        	'created_at' => $date,
        	'updated_at' => $date
        ]);
    }
}
