<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;
use Illuminate\support\Facades\Hash;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert(
        [
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'role'=>'admin',
            'password'=>Hash::make('123456789')

        ]
        );
        
    }
}
