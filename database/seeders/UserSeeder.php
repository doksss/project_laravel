<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $num = 1;
        while($num<5){
            DB::table('users')->insert([
                'name'=>Str::random(10),
                'email'=>Str::random(10).'@gmail.com',
                'password'=>Hash::make('password'),
                'remember_token'=>Str::random(10),

            ]);
            $num++;
        }
        
    }
}
