<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('restaurants')->insert([
            ['restaurant_name' => 'رستوران 1'],
            ['phone' => '09121234567'],
            ['credit_card_number' => '209121234567'],
            ['address' => 'iran tehran'],
            ['profile_status' => true],
            ['user_id' => '2'],
            ['restaurant_category_id' => '1'],

        ]);
    }
}
