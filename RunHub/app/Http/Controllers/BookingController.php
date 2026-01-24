<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request, Item $item)
    {
        // 1. التحقق من تسجيل الدخول
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً لإتمام الحجز');
        }

        // 2. التحقق من البيانات (بما فيها الهوية)
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'identity_image' => 'required|image|mimes:jpeg,png,jpg|max:4096', // ✅ الهوية ضرورية
            'notes' => 'nullable|string|max:500',
        ]);

        // 3. فحص التوفر (نفس المنطق السابق)
        $isBooked = Booking::where('item_id', $item->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('start_date', '<', $request->start_date)
                            ->where('end_date', '>', $request->end_date);
                    });
            })->exists();

        if ($isBooked) {
            return back()->with('error', 'عذراً! المعدة محجوزة بالفعل في هذه الفترة.');
        }

        // 4. رفع صورة الهوية
        $identityPath = $request->file('identity_image')->store('identities', 'public');

        // 5. حساب السعر
        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);
        $days = $start->diffInDays($end) ?: 1;
        $totalPrice = $days * $item->price_per_day;

        // 6. إنشاء الحجز (حالة pending مباشرة)
        Booking::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $totalPrice,
            'identity_image' => '/storage/' . $identityPath, // ✅ حفظ المسار
            'notes' => $request->notes,
            'status' => 'pending', // ✅ انتظار موافقة المزود
        ]);

        // التوجيه للوحة التحكم بدلاً من الدفع
        return redirect()->route('dashboard')->with('success', 'تم إرسال طلبك بنجاح! يرجى انتظار اتصال من المزود لتأكيد التفاصيل.');
    }

    public function cancel($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($booking->status == 'pending') {
            $booking->update(['status' => 'cancelled']);
            return back()->with('success', 'تم إلغاء الطلب بنجاح.');
        }

        return back()->with('error', 'لا يمكن إلغاء الطلب في هذه المرحلة.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->user_id !== Auth::id()) abort(403);
        $booking->delete();
        return back()->with('success', 'تم حذف السجل.');
    }

    // صفحة عرض الحجوزات للمستأجر
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->latest()->get();
        return view('bookings.index', compact('bookings'));
    }
}
