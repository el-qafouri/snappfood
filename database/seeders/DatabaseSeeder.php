<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([PermissionSeeder::class]);

//        $user = User::query()->create([
//            'name' => 'admin',
//            'email' => 'admin@gmail.com',
//            'phone' => '09981928271',
//            'password' => 'password'
//        ]);
//        $user1 = User::query()->create([
//            'name' => 'test seller',
//            'email' => 'seller@gmail.com',
//            'phone' => '09981928272',
//            'password' => 'password'
//        ]);
//        $user->assignRole(Role::query()->first());
//        $user1->assignRole(Role::query()->find(2));

    }
}
