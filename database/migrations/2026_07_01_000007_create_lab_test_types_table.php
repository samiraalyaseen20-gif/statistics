<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lab_test_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // RBS, WBC, Hp, PCV, HIV...
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('lab_test_types'); }
};
