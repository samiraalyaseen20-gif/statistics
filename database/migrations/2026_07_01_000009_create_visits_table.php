<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->foreignId('clinic_unit_id')->constrained('clinic_units')->cascadeOnDelete();
            // موقع المريض
            $table->foreignId('governorate_id')->nullable()->constrained('governorates')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            // حالة الدفع
            $table->enum('status', ['مدفوع', 'غير مدفوع'])->default('غير مدفوع');
            $table->date('visit_date');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('visits'); }
};
