<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // استيراد الموديل
use App\Models\Booking;
class DashboardController extends Controller
{
public function index()
    {
        // جلب حجوزات المستخدم الحالي
        $bookings = Booking::where('user_id', Auth::id())
            ->with('item.user') // جلب بيانات المعدة وصاحبها لتسريع الصفحة
            ->latest() // الأحدث أولاً
            ->get();

        // إرسال البيانات لملف العرض dashboard
        return view('dashboard', compact('bookings'));
    }
}
