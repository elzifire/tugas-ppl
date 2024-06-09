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

        // tolong buatkan user baru sebanyak 20 buah dengan role user dan status active menggunakan looping        
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'),
                'role_id' => $userRole->id,
                'point' => $i * 100,
                'status_id' => $activeStatus->id,
            ]);
        }
        
        
    }
}
