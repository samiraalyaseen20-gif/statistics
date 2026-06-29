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
        User::create([
            'name' => 'مدير النظام',
            'username' => 'admin',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'موظف الاستقبال',
            'username' => 'employee',
            'password' => Hash::make('123456'),
            'role' => 'employee',
        ]);

        User::create([
            'name' => 'زائر',
            'username' => 'visitor',
            'password' => Hash::make('123456'),
            'role' => 'visitor',
        ]);
    }
}
