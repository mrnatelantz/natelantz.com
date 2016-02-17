<?php

use Illuminate\Database\Seeder;
use App\User;

class MyUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
    		'name' => 'admin',
    		'email' => 'admin@email.com',
    		'password' => bcrypt('password')
    	]);
    }
}
