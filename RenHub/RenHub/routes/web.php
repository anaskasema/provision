<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| المسارات العامة (Public Routes) - متاحة للجميع
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/items', [ItemController::class, 'index'])->name('items.index');

// الصفحات الثابتة
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::post('/contact', [PageController::class, 'sendMessage'])->name('contact.send');
Route::get('/terms', [PageController::class, 'terms'])->name('pages.terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('pages.privacy');
Route::get('/team', function () {
    return view('pages.team');})->name('pages.team');
/*
|--------------------------------------------------------------------------
| المسارات المحمية (Authenticated Routes) - للمسجلين فقط
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'banned'])->group(function () {

    // 1. المشترك (المستأجر والمزود) - الصفحة الرئيسية
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // الملف الشخصي
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. إدارة العناصر (المعدات)
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

    // 3. الحجوزات والدفع
    Route::post('/items/{item}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy'); // حذف من السجل

    // الدفع


    // صفحة عرض حجوزاتي (للمستأجر)
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');

    // 4. التقييمات
    Route::post('/items/{item}/review', [ReviewController::class, 'store'])->name('reviews.store');

    // 5. المفضلة
    Route::post('/items/{item}/favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
       Route::post('/items/{item}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    // =========================================================
    // 6. منطقة المزودين (Providers Only)
    // =========================================================
    Route::middleware('role:provider')->prefix('provider')->name('provider.')->group(function () {
        Route::get('/dashboard', [ProviderController::class, 'index'])->name('dashboard');
        Route::post('/bookings/{id}/approve', [ProviderController::class, 'approve'])->name('bookings.approve');
        Route::post('/bookings/{id}/reject', [ProviderController::class, 'reject'])->name('bookings.reject');
        Route::post('/bookings/{id}/complete', [ProviderController::class, 'complete'])->name('bookings.complete');
    });
    // مسار عرض العقد الإلكتروني
    Route::get('/bookings/{id}/contract', [ProviderController::class, 'showContract'])->name('bookings.contract');

    // =========================================================
    // 7. منطقة الأدمن (Admins Only)
    // =========================================================
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

        // الرئيسية (الإحصائيات)
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // إعدادات النظام
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');

        // إدارة المستخدمين
        Route::get('/users', [AdminController::class, 'users'])->name('users'); // القائمة

        // 🔥🔥 الكود الجديد: إنشاء مستخدم (يجب أن يكون قبل route show) 🔥🔥
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');

        // التحكم بالمستخدمين
        Route::post('/users/{user}/ban', [AdminController::class, 'toggleBan'])->name('users.ban'); // حظر
        Route::post('/users/{user}/role', [AdminController::class, 'changeRole'])->name('users.role'); // تغيير دور

        // تفاصيل المستخدم وتعديله
        Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');

        // الحجوزات
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');

        // إدارة الرسائل
        Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
        Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('messages.delete');
    });
});

/*
|--------------------------------------------------------------------------
| المسارات العامة المتغيرة (Wildcard Routes)
|--------------------------------------------------------------------------
*/
// يجب أن يكون في النهاية لكي لا يتداخل مع المسارات الأخرى
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

require __DIR__ . '/auth.php';
