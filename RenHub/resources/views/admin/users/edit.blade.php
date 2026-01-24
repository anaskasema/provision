@extends('layouts.admin')

@section('title', 'تعديل المستخدم: ' . $user->first_name)

@section('content')

    {{-- 1. الهيدر الكحلي الفخم --}}
    <div class="relative bg-slate-900 py-12 pb-24 rounded-3xl overflow-hidden shadow-lg mx-4 mt-4">
        {{-- الخلفية --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>

        <div class="relative z-10 px-8 flex flex-col md:flex-row justify-between items-end gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-2 flex items-center gap-3">
                    <i class="fa-solid fa-user-pen text-orange-500"></i> تعديل بيانات العضو
                </h1>
                <p class="text-slate-400">تحديث المعلومات الشخصية، الصلاحيات، وكلمة المرور للمستخدم <span
                        class="text-white font-bold">{{ $user->first_name }}</span>.</p>
            </div>

            <a href="{{ route('admin.users.show', $user->id) }}"
                class="bg-white/10 hover:bg-white/20 text-white border border-white/10 px-6 py-3 rounded-2xl font-bold text-sm transition flex items-center gap-2 backdrop-blur-md">
                <i class="fa-solid fa-arrow-right"></i> رجوع للملف
            </a>
        </div>
    </div>

    {{-- 2. المحتوى المتداخل (-mt-16) --}}
    <div class="px-4 -mt-16 relative z-20 pb-20">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden">

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-8 md:p-10">
                    @csrf
                    @method('PUT')

                    {{-- قسم البيانات الشخصية --}}
                    <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-2">
                        <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
                            <i class="fa-regular fa-id-card"></i>
                        </div>
                        البيانات الأساسية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">الاسم الأول</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition font-bold text-slate-800 placeholder-slate-400">
                            @error('first_name')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">الاسم الأخير</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition font-bold text-slate-800 placeholder-slate-400">
                            @error('last_name')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">البريد الإلكتروني</label>
                            <div class="relative group">
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 pl-10 focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition font-medium text-slate-800 group-hover:bg-white">
                                <i
                                    class="fa-regular fa-envelope absolute left-4 top-4 text-slate-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                            @error('email')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">رقم الهاتف</label>
                            <div class="relative group">
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 pl-10 focus:outline-none focus:border-orange-500 focus:bg-white focus:ring-1 focus:ring-orange-500 transition font-medium text-slate-800 group-hover:bg-white text-left dir-ltr">
                                <i
                                    class="fa-solid fa-phone absolute left-4 top-4 text-slate-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                            @error('phone')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- قسم الصلاحيات --}}
                    @if ($user->id !== auth()->id())
                        <h3
                            class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-2 pt-4">
                            <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center text-orange-600">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            الصلاحيات
                        </h3>
                        <div class="mb-8">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">نوع الحساب (Role)</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                {{-- خيار مستأجر --}}
                                <label class="cursor-pointer relative group">
                                    <input type="radio" name="role" value="user" class="peer sr-only"
                                        {{ $user->role == 'user' ? 'checked' : '' }}>
                                    <div
                                        class="w-full p-4 rounded-2xl border-2 border-slate-100 bg-white hover:border-orange-200 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-700 transition-all text-center shadow-sm">
                                        <div
                                            class="w-10 h-10 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-2 text-slate-400 peer-checked:bg-orange-200 peer-checked:text-orange-600">
                                            <i class="fa-solid fa-user text-lg"></i>
                                        </div>
                                        <span class="font-bold text-sm block">مستأجر (User)</span>
                                    </div>
                                    <div
                                        class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-orange-500 transition-opacity">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                </label>

                                {{-- خيار مزود خدمة --}}
                                <label class="cursor-pointer relative group">
                                    <input type="radio" name="role" value="provider" class="peer sr-only"
                                        {{ $user->role == 'provider' ? 'checked' : '' }}>
                                    <div
                                        class="w-full p-4 rounded-2xl border-2 border-slate-100 bg-white hover:border-blue-200 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-checked:text-blue-700 transition-all text-center shadow-sm">
                                        <div
                                            class="w-10 h-10 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-2 text-slate-400 peer-checked:bg-blue-200 peer-checked:text-blue-600">
                                            <i class="fa-solid fa-briefcase text-lg"></i>
                                        </div>
                                        <span class="font-bold text-sm block">مزود خدمة (Provider)</span>
                                    </div>
                                    <div
                                        class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-blue-600 transition-opacity">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                </label>

                                {{-- خيار مدير --}}
                                <label class="cursor-pointer relative group">
                                    <input type="radio" name="role" value="admin" class="peer sr-only"
                                        {{ $user->role == 'admin' ? 'checked' : '' }}>
                                    <div
                                        class="w-full p-4 rounded-2xl border-2 border-slate-100 bg-white hover:border-red-200 peer-checked:border-red-600 peer-checked:bg-red-50 peer-checked:text-red-700 transition-all text-center shadow-sm">
                                        <div
                                            class="w-10 h-10 mx-auto bg-slate-50 rounded-full flex items-center justify-center mb-2 text-slate-400 peer-checked:bg-red-200 peer-checked:text-red-600">
                                            <i class="fa-solid fa-shield-cat text-lg"></i>
                                        </div>
                                        <span class="font-bold text-sm block">مدير (Admin)</span>
                                    </div>
                                    <div
                                        class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-red-600 transition-opacity">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    @else
                        {{-- إذا كان يعدل نفسه، لا تظهر خيارات الدور --}}
                        <input type="hidden" name="role" value="{{ $user->role }}">
                    @endif

                    {{-- قسم تغيير كلمة المرور --}}
                    <div class="bg-orange-50/50 p-6 rounded-2xl border border-orange-100 mb-8 mt-8">
                        <h4 class="font-bold text-orange-800 mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-key"></i> تعيين كلمة مرور جديدة
                        </h4>
                        <p class="text-xs text-orange-600/70 mb-4 font-medium">اترك هذا الحقل فارغاً إذا كنت لا تريد تغيير
                            كلمة المرور الحالية.</p>

                        <div class="relative group">
                            <input type="password" name="password" placeholder="أدخل كلمة المرور الجديدة..."
                                class="w-full bg-white border border-orange-200 rounded-xl px-5 py-3.5 pl-10 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition font-medium">
                            <i
                                class="fa-solid fa-lock absolute left-4 top-4 text-orange-300 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                        @error('password')
                            <span class="text-red-600 text-xs mt-2 block font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- أزرار التحكم --}}
                    <div
                        class="flex flex-col-reverse md:flex-row justify-end items-center gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.users') }}"
                            class="w-full md:w-auto text-center text-slate-500 hover:text-slate-800 font-bold text-sm px-6 py-3 transition">
                            إلغاء وعودة
                        </a>

                        <button type="submit"
                            class="w-full md:w-auto bg-slate-900 text-white px-8 py-3.5 rounded-2xl font-bold hover:bg-orange-600 transition shadow-lg shadow-slate-900/20 hover:-translate-y-1 flex justify-center items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i> حفظ التغييرات
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
