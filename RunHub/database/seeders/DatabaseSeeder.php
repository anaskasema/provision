<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. إنشاء مستخدم الأدمن (إذا لم يكن موجوداً)
        $admin = User::where('email', 'admin@renthub.com')->first();
        if (!$admin) {
            User::factory()->create([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@renthub.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        // 2. قائمة الأقسام الجديدة (القائمة الكاملة)
        // ... داخل DatabaseSeeder.php ...
        $categoriesData = [
            ['name' => 'معدات ثقيلة', 'slug' => 'heavy-equipment', 'icon' => 'fa-solid fa-truck-monster'],
            ['name' => 'سيارات فاخرة', 'slug' => 'luxury-cars', 'icon' => 'fa-solid fa-car'],
            ['name' => 'دراجات نارية', 'slug' => 'motorcycles', 'icon' => 'fa-solid fa-motorcycle'],
            ['name' => 'معدات تصوير', 'slug' => 'cameras', 'icon' => 'fa-solid fa-camera'],
            ['name' => 'لوازم حفلات', 'slug' => 'party-supplies', 'icon' => 'fa-solid fa-cake-candles'],
            ['name' => 'أدوات كهربائية', 'slug' => 'power-tools', 'icon' => 'fa-solid fa-plug'],
            ['name' => 'معدات تخييم', 'slug' => 'camping', 'icon' => 'fa-solid fa-campground'],
            ['name' => 'عقارات', 'slug' => 'real-estate', 'icon' => 'fa-solid fa-house'],
        ];
        // ... باقي الكود كما هو ...

        foreach ($categoriesData as $data) {
            // نستخدم firstOrCreate لمنع التكرار إذا شغلت الأمر مرتين
            Category::firstOrCreate(
                ['slug' => $data['slug']], // البحث عن طريق slug
                $data // البيانات التي سيتم إنشاؤها
            );
        }

        // 3. إنشاء 10 معدات تجريبية وتوزيعها على أقسام عشوائية
        // نحصل على كل الـ IDs الخاصة بالأقسام
        $categoryIds = Category::pluck('id');

        Item::factory(10)->make()->each(function ($item) use ($categoryIds) {
            $item->user_id = 1; // نفترض أنها تابعة للأدمن أو المستخدم رقم 1
            $item->category_id = $categoryIds->random(); // اختيار قسم عشوائي
            $item->save();
        });
    }
}
