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
        // 1. Create classifications table
        Schema::create('classifications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        // 2. Add classification column to surgeries table
        Schema::table('surgeries', function (Blueprint $table) {
            $table->string('classification')->nullable()->after('operation_name_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surgeries', function (Blueprint $table) {
            $table->dropColumn('classification');
        });

        Schema::dropIfExists('classifications');
    }
};
