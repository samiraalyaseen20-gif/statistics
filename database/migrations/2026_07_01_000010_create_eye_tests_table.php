<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('eye_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')->constrained('visits')->cascadeOnDelete();
            $table->foreignId('test_type_id')->constrained('test_types')->cascadeOnDelete();
            $table->date('test_date');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('eye_tests'); }
};
