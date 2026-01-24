<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        return [
            'user_id' => 1, // سنفترض وجود مستخدم رقم 1
            'category_id' => 1, // سنفترض وجود فئة رقم 1
            'title' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => $this->faker->paragraph(),
            'price_per_day' => $this->faker->numberBetween(1000, 50000),
            'city' => 'صنعاء', // مثال
            'is_available' => true,
            'images' => json_encode(['https://th.bing.com/th/id/R.7249c7d17e52826c28d80aae1a629c01?rik=tHk3zNeZgFWZKA&pid=ImgRaw&r=0']), // صورة عشوائية
            'specifications' => json_encode(['الحالة' => 'جديد', 'اللون' => 'أحمر']),
        ];
    }
}
