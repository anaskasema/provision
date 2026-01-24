<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // ✅ للتأكد من حذف الصورة القديمة إذا تطلب الأمر

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // 1. تحديث البيانات النصية (الاسم، الهاتف، المدينة، الإيميل)
        // نستخدم input مباشرة لضمان وصول البيانات حتى لو لم تكن في rules
        $user->first_name = $request->input('first_name');
        $user->last_name  = $request->input('last_name');
        $user->phone      = $request->input('phone'); // ✅ التأكد من حفظ الهاتف
        $user->city       = $request->input('city');
        $user->email      = $request->input('email');

        // إذا تغير الإيميل، نعيد تصفير تاريخ التحقق
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 2. تحديث الصورة الشخصية (Avatar)
        if ($request->hasFile('avatar')) {
            // (اختياري) حذف الصورة القديمة إذا كانت موجودة وليست الصورة الافتراضية
            if ($user->avatar) {
                // منطق حذف الصورة القديمة يمكن إضافته هنا إذا أردت توفير المساحة
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = '/storage/' . $path;
        }

        // 3. تحديث كلمة المرور (إذا تم تعبئة الحقول)
        if ($request->filled('current_password') && $request->filled('password')) {
            
            // التحقق من صحة كلمة المرور الحالية وتطابق الجديدة
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'confirmed', 'min:8'],
            ]);

            // التحديث
            $user->password = Hash::make($request->password);
        }

        // 4. حفظ التغييرات في قاعدة البيانات
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}