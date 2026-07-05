<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_surgery_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->string('classification');        // صغرى / وسطى / كبرى / فوق الكبرى / خاصة
            $table->string('sector_key');            // gov / pri / pub  (مفتاح القطاع)
            $table->foreignId('sector_id')->constrained('sectors')->cascadeOnDelete();
            $table->date('stat_month');              // أول يوم من الشهر: 2026-02-01
            $table->unsignedInteger('quantity')->default(0);
            $table->timestamps();

            // ضمان عدم التكرار: طبيب + تصنيف + قطاع + شهر = سجل واحد فريد
            $table->unique(['doctor_id', 'classification', 'sector_key', 'stat_month'], 'doc_cls_sec_month_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_surgery_stats');
    }
};
