<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin #1
        Admin::create(['email' => 'cheyannemchardy@hotmail.com', 'password' => Hash::make('p@s$word')]);
    }
}
