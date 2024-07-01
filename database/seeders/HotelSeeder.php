<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->insert([
            'name' => "Dothan Inn & Suites",
            'address' => "3285 Montgomery Hwy",
            'address2' => "Nowhere",
            'postcode' => "36303-2108",
            'city' => "Dothan",
            'state' => "Alabama",
            'longitude' => mt_rand(1,100),
            'latitude' => mt_rand(1,100),
            'phone' => "081238674",
            'fax' => "1 913 727-2777",
            'email' => "keren@yahoo.com",
            'currency' => "USD",
            'accommodation_type' => "Hotel",
            'web' => "hotel.com",
            'type_id' => mt_rand(1,4),

        ]);
    }
}
