<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // 1. التحقق: هل المستخدم استأجر هذه المعدة فعلاً وحالته مكتملة؟
        // وهل لم يقم بتقييم هذا الحجز من قبل؟
        $booking = Booking::where('user_id', Auth::id())
            ->where('item_id', $item->id)
            ->whereIn('status', ['completed', 'confirmed']) // نسمح للمؤكد والمكتمل بالتقييم
            ->whereDoesntHave('review') // لم يتم تقييمه مسبقاً
            ->latest()
            ->first();

        if (!$booking) {
            return back()->with('error', 'عذراً، لا يمكنك تقييم معدة لم تقم بتجربتها أو قمت بتقييمها سابقاً.');
        }

        // 2. حفظ التقييم
        Review::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'booking_id' => $booking->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'شكراً لك! تم إضافة تقييمك بنجاح.');
    }
}
