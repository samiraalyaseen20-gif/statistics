<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('operation_names', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // التصنيف: صغرى / وسطى (حقن) / وسطى (ليزر) / كبرى / فوق الكبرى / خاصة
            $table->enum('classification', ['صغرى', 'وسطى (حقن)', 'وسطى (ليزر)', 'كبرى', 'فوق الكبرى', 'خاصة']);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('operation_names'); }
};
