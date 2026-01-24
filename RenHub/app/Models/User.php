<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'role',
        'city',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ===========================================
    // 👇 العلاقات (يجب أن تكون هنا داخل الكلاس) 👇
    // ===========================================

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * علاقة المستخدم بالمعدات التي يملكها
     * One-to-Many Relationship
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    // قائمة المفضلة
    // 🔥🔥 هذا هو الكود الناقص لحل مشكلة الكنترولر 🔥🔥
    public function favorites()
    {
        return $this->belongsToMany(Item::class, 'favorites', 'user_id', 'item_id')->withTimestamps();
    }
}
