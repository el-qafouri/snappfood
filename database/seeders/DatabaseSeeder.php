<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([PermissionSeeder::class]);

        $user = User::query()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '09981928271',
            'password' => 'password'
        ]);

    }
}
