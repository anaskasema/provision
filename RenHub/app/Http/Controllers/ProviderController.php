<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ProviderController extends Controller
{
    // عرض الطلبات الواردة للمزود
    public function index()
    {
        $incomingBookings = Booking::whereHas('item', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->where('status', '!=', 'cancelled') // نعرض كل شيء ما عدا الملغي من قبل العميل
            ->latest()
            ->get();
            
        $myItems = Item::where('user_id', Auth::id())->latest()->get();

        return view('provider.dashboard', compact('incomingBookings', 'myItems'));
    }

    // الموافقة على الحجز (توليد العقد)
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->item->user_id !== Auth::id()) abort(403);

        // تحويل الحالة إلى مؤكد (يعني تم الاتفاق والدفع خارجياً)
        $booking->update(['status' => 'confirmed']);

        return back()->with('success', 'تم تأكيد الحجز! يمكنك الآن طباعة عقد الإيجار.');
    }

    // رفض الحجز
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->item->user_id !== Auth::id()) abort(403);

        $booking->update(['status' => 'rejected']); // حالة رفض خاصة بالمزود

        return back()->with('success', 'تم رفض الطلب.');
    }

    // إنهاء الحجز واستلام المعدة
    public function complete($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->item->user_id !== Auth::id()) abort(403);

        $booking->update(['status' => 'completed']);

        return back()->with('success', 'تم إكمال العملية بنجاح.');
    }
    
    // ✅ دالة جديدة: عرض العقد الإلكتروني
    public function showContract($id)
    {
        $booking = Booking::with(['user', 'item.user'])->findOrFail($id);
        
        // الحماية: العقد يراه فقط الطرفان (المزود والمستأجر) والأدمن
        $isParty = $booking->user_id === Auth::id() || $booking->item->user_id === Auth::id() || Auth::user()->role === 'admin';
        
        if (!$isParty) abort(403);
        
        // يجب أن يكون الحجز مؤكداً أو مكتملاً لرؤية العقد
        if (!in_array($booking->status, ['confirmed', 'completed'])) {
            return back()->with('error', 'العقد متاح فقط للحجوزات المؤكدة.');
        }

        return view('bookings.contract', compact('booking'));
    }
}