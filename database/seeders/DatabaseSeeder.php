<?php
// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // // Buat role super_admin jika belum ada
        // $role = Role::firstOrCreate(['name' => 'super_admin']);

        // // Buat user super admin
        // $user = User::firstOrCreate(
        //     ['email' => 'superadmin@example.com'],
        //     [
        //         'name' => 'Super Admin',
        //         'password' => Hash::make('@PasswordSuperAdmin'), // gunakan Hash::make di sini
        //     ]
        // );

        // // Assign role super_admin ke user
        // $user->assignRole($role);
    }
}
