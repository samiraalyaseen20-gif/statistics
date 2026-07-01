<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('can_view_reports')->default(false)->after('role');
            $table->boolean('can_enter_data')->default(false)->after('can_view_reports');
            $table->boolean('can_manage_lookups')->default(false)->after('can_enter_data');
            $table->boolean('can_manage_users')->default(false)->after('can_manage_lookups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['can_view_reports', 'can_enter_data', 'can_manage_lookups', 'can_manage_users']);
        });
    }
};
