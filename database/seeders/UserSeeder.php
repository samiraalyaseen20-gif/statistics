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
                'can_view_reports'   => true,
                'can_enter_data'     => true,
                'can_manage_lookups' => true,
                'can_manage_users'   => true,
            ]
        );

        User::updateOrCreate(
            ['username' => 'employee'],
            [
                'name' => 'موظف الاستقبال',
                'password' => Hash::make('123456'),
                'role' => 'employee',
                'can_view_reports'   => false,
                'can_enter_data'     => false,
                'can_manage_lookups' => false,
                'can_manage_users'   => false,
            ]
        );

        User::updateOrCreate(
            ['username' => 'visitor'],
            [
                'name' => 'زائر',
                'password' => Hash::make('123456'),
                'role' => 'visitor',
                'can_view_reports'   => true,
                'can_enter_data'     => false,
                'can_manage_lookups' => false,
                'can_manage_users'   => false,
            ]
        );
    }
}
