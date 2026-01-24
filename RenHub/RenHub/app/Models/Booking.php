<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

 protected $fillable = [
        'user_id',
        'item_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'identity_image', // ✅ جديد
        'notes',          // ✅ جديد
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // علاقة: الحجز يتبع معدة
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // علاقة: الحجز يتبع مستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
