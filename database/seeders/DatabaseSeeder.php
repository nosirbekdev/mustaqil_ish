<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin foydalanuvchini yaratish uchun AdminUserSeeder'ni chaqirish

        $this->call(RoleSeeder::class);
        $this->call(AdminUserSeeder::class);

    }
}
