<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['name'=>'Special Breakfast','hotel_id'=>1],
            ['name'=>'Gym','hotel_id'=>2],
            ['name'=>'Sauna','hotel_id'=>2]
        ]);
    }
}
