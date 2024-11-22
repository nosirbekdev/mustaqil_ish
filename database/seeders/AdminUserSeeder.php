<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Agar admin roli mavjud bo'lmasa, uni yaratamiz
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Admin foydalanuvchisini yaratish
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', // O'zgartiring
            'password' => bcrypt('adminpassword'), // O'zgartiring
        ]);

        // Foydalanuvchiga "admin" rolini tayinlash
        $user->assignRole('admin');
    }
}
