<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. استدعاء الكلاس
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // ✅ ضروري جداً لحل مشكلة check

class Item extends Model
{
    use HasFactory; // 2. تفعيل الميزة

    // لحماية البيانات، نحدد الحقول المسموح تعبئتها
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'price_per_day',
        'price_per_hour',
        'currency',
        'city',
        'address',
        'is_available',
        'specifications',
        'images',
    ];

    // تحديد نوع البيانات للمصفوفات (Casting) ليتم التعامل معها كـ JSON تلقائياً
    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'is_available' => 'boolean',
    ];

    // علاقة: المعدة تتبع مستخدم (مزود)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // علاقة: المعدة تتبع فئة
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    // علاقة التقييمات
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // دالة مساعدة لحساب متوسط النجوم (مثلاً 4.5)
    public function rating()
    {
        return round($this->reviews()->avg('rating'), 1) ?? 0;
    }
    // من قام بتفضيل هذه المعدة
    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites', 'item_id', 'user_id')->withTimestamps();
    }

    // 🔥 دالة الفحص (تم تعديلها لاستخدام Auth Facade) 🔥
    public function isFavorited()
    {
        // استخدام Auth::check() بدلاً من auth()->check() يحل مشكلة المحرر
        if (!Auth::check()) {
            return false;
        }

        return $this->favoritedBy->contains(Auth::id());
    }
    // داخل كلاس Item
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
