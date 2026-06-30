<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->foreignId('operation_name_id')->constrained('operation_names')->cascadeOnDelete();
            $table->foreignId('sector_id')->constrained('sectors')->cascadeOnDelete();
            // موقع المريض
            $table->foreignId('governorate_id')->nullable()->constrained('governorates')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->date('op_date');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('surgeries'); }
};
