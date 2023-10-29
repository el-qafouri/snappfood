<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name'=>'admin'
            ],
            [
                'name'=>'customer'
            ],
            [
                'name'=>'seller'
            ]
        ]);


        DB::table('permissions')->insert([
            ['name' => 'create-food-category'],
            ['name' => 'delete-food-category'],
            ['name' => 'edit-food-category'],
            ['name' => 'create-restaurant-category'],
            ['name' => 'delete-restaurant-category'],
            ['name' => 'edit-restaurant-category'],
            ['name' => 'accept-seller'],
            ['name' => 'delete-seller'],
            ['name' => 'edit-seller'],
            ['name' => 'add-coupon'],
            ['name' => 'remove-coupon'],
            ['name' => 'edit-coupon'],
            ['name' => 'add-banner'],
            ['name' => 'remove-banner'],
            ['name' => 'view-user'],
            ['name' => 'view-users'],
            ['name' => 'view-sellers'],
            ['name' => 'add-restaurant'],
            ['name' => 'remove-restaurant'],
            ['name' => 'add-food'],
            ['name' => 'edit-food'],
            ['name' => 'delete-food'],

        ]);
    }
}