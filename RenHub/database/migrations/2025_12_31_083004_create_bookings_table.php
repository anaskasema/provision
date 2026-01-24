<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');

            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 10, 2);

            // ✅ الإضافات الجديدة لنظام الهوية
            $table->string('identity_image'); // صورة البطاقة (إجبارية)
            $table->text('notes')->nullable(); // ملاحظات للمزود

            // الحالات: يبدأ بـ pending مباشرة لأن الدفع يدوي
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
