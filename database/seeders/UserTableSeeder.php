<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed roles
        $adminRole = Role::create(['role_name' => 'admin']);
        $userRole = Role::create(['role_name' => 'user']);
        
        // Seed statuses
        $activeStatus = Status::create(['status_name' => 'active']);
        $inactiveStatus = Status::create(['status_name' => 'inactive']);

        // Seed users
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password'),
            'role_id' => $adminRole->id,
            'status_id' => $activeStatus->id,
        ]);

        User::create([
            'name' => 'User 1',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'role_id' => $userRole->id,
            'status_id' => $activeStatus->id,
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
            'role_id' => $userRole->id,
            'status_id' => $inactiveStatus->id,
        ]);
    }
}
