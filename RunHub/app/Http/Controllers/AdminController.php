<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Booking;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // ✅ تم الحل
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    // 1. لوحة القيادة والتقارير
    public function index(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : Carbon::now()->subDays(30);
        $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : Carbon::now();

        $stats = [
            'revenue' => Booking::whereIn('status', ['confirmed', 'completed'])->whereBetween('created_at', [$startDate, $endDate])->sum('total_price'),
            'bookings_count' => Booking::whereBetween('created_at', [$startDate, $endDate])->count(),
            'new_users' => User::whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_users' => User::count(),
            'total_providers' => User::where('role', 'provider')->count(),
            'total_items' => Item::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
        ];

        // الرسم البياني
        $chartData = Booking::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total_price) as revenue'))
            ->whereIn('status', ['confirmed', 'completed'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')->orderBy('date')->get();

        $chartLabels = $chartData->pluck('date');
        $chartValues = $chartData->pluck('revenue');

        $recentUsers = User::latest()->take(5)->get();
        $recentBookings = Booking::with(['user', 'item'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'startDate', 'endDate', 'chartLabels', 'chartValues', 'recentUsers', 'recentBookings'));
    }

    // 2. إدارة المستخدمين والمزودين
    public function users(Request $request)
    {
        $query = User::withCount('items')->latest();
        if ($request->has('search')) {
            $query->where('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }
        if ($request->has('role') && $request->role != 'all') {
            $query->where('role', $request->role);
        }
        $users = $query->paginate(15)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    // تقرير تفصيلي عن المزود (أرباحه، معداته، حجوزاته)
    public function showUser(User $user)
    {
        // 1. جلب المعدات المملوكة لهذا المستخدم (سواء كان مزود أو أدمن)
        $items = $user->items()->latest()->get();

        // 2. جلب الحجوزات التي قام بها هذا المستخدم (كمستأجر)
        $bookings = \App\Models\Booking::where('user_id', $user->id)
            ->with('item') // جلب بيانات المعدة لتجنب الاستعلامات الكثيرة
            ->latest()
            ->get();

        // 3. حساب الإحصائيات المالية

        // أ) كم صرف هذا المستخدم؟ (كمستأجر)
        // نحسب فقط الحجوزات المؤكدة أو المكتملة
        $totalSpent = $bookings->whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        // ب) كم ربح هذا المستخدم؟ (كمزود أو أدمن)
        // نجلب الحجوزات الواردة على معداته
        $receivedBookings = \App\Models\Booking::whereIn('item_id', $items->pluck('id'))->get();

        $totalEarnings = $receivedBookings->whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        $completedOrdersCount = $receivedBookings->where('status', 'completed')->count();
        $bookingsReceivedCount = $receivedBookings->count();

        // ج) الحجوزات النشطة حالياً (للمستأجر)
        $activeBookingsCount = $bookings->whereIn('status', ['pending', 'confirmed'])->count();

        // تجميع البيانات للملف
        $wallet = [
            'total_earnings' => $totalEarnings,   // إجمالي الأرباح
            'total_spent' => $totalSpent,         // إجمالي المصروفات
            'completed_orders' => $completedOrdersCount,
            'items_count' => $items->count(),
        ];

        return view('admin.users.show', compact(
            'user',
            'items',
            'bookings',
            'wallet',
            'bookingsReceivedCount',
            'activeBookingsCount'
        ));
    }
    // تعديل المستخدم
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate(['first_name' => 'required', 'email' => 'required|email|unique:users,email,' . $user->id]);
        $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'role']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect()->route('admin.users.show', $user->id)->with('success', 'تم تحديث البيانات بنجاح');
    }

    // الحظر (الآن سيعمل لأننا فعلناه في الخطوة 1)
    public function toggleBan(User $user)
    {
        if ($user->id === Auth::id()) return back()->with('error', 'لا يمكنك حظر نفسك!');
        $user->is_banned = !$user->is_banned;
        $user->save();
        $msg = $user->is_banned ? 'تم حظر المستخدم ومنعه من الدخول' : 'تم فك الحظر';
        return back()->with('success', $msg);
    }

    public function changeRole(Request $request, User $user)
    {
        if ($user->id === Auth::id()) return back()->with('error', 'لا تغير صلاحياتك!');
        $user->role = $request->role;
        $user->save();
        return back()->with('success', 'تم تغيير الصلاحية');
    }

    // 3. الحجوزات
    public function bookings(Request $request)
    {
        $query = Booking::with(['user', 'item.user'])->latest();
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        $bookings = $query->paginate(20)->withQueryString();
        return view('admin.bookings.index', compact('bookings'));
    }

    // 4. الرسائل
    public function messages()
    {
        $messages = Message::latest()->paginate(15);
        return view('admin.messages', compact('messages'));
    }

    public function deleteMessage($id)
    {
        Message::findOrFail($id)->delete();
        return back()->with('success', 'تم الحذف');
    }

    // 5. الإعدادات
    public function settings()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        if ($request->hasFile('site_logo')) {
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'site_logo'], ['value' => '/storage/' . $path]);
        }
        $data = $request->except(['_token', 'site_logo']);
        if (!isset($data['maintenance_mode'])) $data['maintenance_mode'] = '0';
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return back()->with('success', 'تم تحديث الإعدادات');
    }
    // 1. عرض صفحة إنشاء مستخدم جديد
    public function createUser()
    {
        return view('admin.users.create');
    }

    // 2. حفظ المستخدم الجديد في قاعدة البيانات
    public function storeUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|min:8', // كلمة السر مطلوبة هنا
            'role' => 'required|in:user,provider,admin',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password), // تشفير كلمة السر
            'role' => $request->role,
            'email_verified_at' => now(), // تفعيل الإيميل تلقائياً لأن الأدمن هو من أضافه
        ]);

        return redirect()->route('admin.users')->with('success', 'تم إنشاء الحساب الجديد بنجاح');
    }
}
