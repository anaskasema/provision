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
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // اسم الفئة
        $table->string('slug')->unique(); // للروابط (SEO Friendly)
        $table->string('icon')->nullable(); // أيقونة الفئة للعرض في التصميم
        $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade'); // للفئات الفرعية
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
