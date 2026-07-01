<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'مدير النظام',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['username' => 'employee'],
            [
                'name' => 'موظف الاستقبال',
                'password' => Hash::make('123456'),
                'role' => 'employee',
            ]
        );

        User::updateOrCreate(
            ['username' => 'visitor'],
            [
                'name' => 'زائر',
                'password' => Hash::make('123456'),
                'role' => 'visitor',
            ]
        );
    }
}
