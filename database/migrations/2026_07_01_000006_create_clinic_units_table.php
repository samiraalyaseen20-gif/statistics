<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('clinic_units', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // استشارية العيون العامة / التخصصات الدقيقة
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('clinic_units'); }
};
