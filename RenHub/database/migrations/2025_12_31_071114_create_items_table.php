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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // صاحب المعدة (المزود)
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // الفئة

            $table->string('title'); // اسم المعدة
            $table->string('slug')->unique();
            $table->text('description');

            // الأسعار
            $table->decimal('price_per_day', 10, 2)->nullable();
            $table->decimal('price_per_hour', 10, 2)->nullable();
            $table->string('currency')->default('YER'); // العملة

            // الموقع والحالة
            $table->string('city');
            $table->string('address')->nullable();
            $table->boolean('is_available')->default(true);

            // الحقل السحري (Clean Code Tip)
            // هنا سنخزن المواصفات المختلفة: { "gear": "auto", "model": "2024" }
            $table->json('specifications')->nullable();

            // الصور (سنخزن المسارات كـ JSON array)
            $table->json('images')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
