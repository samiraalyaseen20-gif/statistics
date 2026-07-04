<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('doctor_operation_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->foreignId('operation_name_id')->constrained('operation_names')->cascadeOnDelete();
            // التصنيف يُؤخذ تلقائياً من operation_name لكن يُخزن هنا للمرونة
            $table->string('classification')->nullable();
            // العدد المُدخل يدوياً
            $table->unsignedInteger('quantity')->default(0);
            // الشهر الإحصائي (YYYY-MM-01)
            $table->date('stat_month');
            $table->timestamps();

            // ضمان عدم تكرار نفس الطبيب+العملية+الشهر
            $table->unique(['doctor_id', 'operation_name_id', 'stat_month'], 'doc_op_month_unique');
        });
    }

    public function down(): void { Schema::dropIfExists('doctor_operation_stats'); }
};
