@extends('layouts.app')

@section('title', 'إعدادات الحساب')

@section('content')

    {{-- الهيدر العلوي: فخامة الكحلي --}}
    <div class="relative bg-slate-900 py-20 pb-32 overflow-hidden">
        {{-- خلفية جمالية --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>

        {{-- تأثيرات ضوئية --}}
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <div
                class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-white/5 backdrop-blur-md border border-white/20 mb-6 text-orange-500 shadow-2xl">
                <i class="fa-solid fa-user-gear text-4xl"></i>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4">إعدادات الحساب</h1>
            <p class="text-slate-400 max-w-xl mx-auto text-lg leading-relaxed">
                تحكم في بياناتك الشخصية وكلمة المرور بكل سهولة وأمان.
            </p>
        </div>
    </div>

    {{-- المحتوى الرئيسي --}}
    <div class="container mx-auto px-4 -mt-20 relative z-20 pb-20">
        <div class="max-w-4xl mx-auto">

            {{-- رسائل النجاح --}}
            @if (session('status') === 'profile-updated')
                <div
                    class="mb-8 bg-green-50 border-r-4 border-green-500 p-4 rounded-xl flex items-center gap-3 shadow-sm animate-bounce-short">
                    <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                    <div>
                        <p class="font-bold text-green-800">تم الحفظ!</p>
                        <p class="text-sm text-green-700">تم تحديث بيانات ملفك الشخصي بنجاح.</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden relative">
                {{-- زخرفة علوية --}}
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-slate-900 to-orange-600"></div>

                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                    class="p-8 md:p-12">
                    @csrf
                    @method('patch')

                    {{-- 1. الصورة الشخصية --}}
                    <div class="flex flex-col items-center mb-12">
                        <div class="relative group cursor-pointer" onclick="document.getElementById('avatarInput').click()">
                            <div
                                class="w-36 h-36 rounded-full border-4 border-white shadow-xl overflow-hidden bg-gray-100 relative ring-4 ring-slate-50 group-hover:ring-orange-100 transition-all duration-300">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" id="avatarPreview"
                                        class="w-full h-full object-cover transition duration-300 group-hover:scale-110 group-hover:opacity-75">
                                @else
                                    <div id="avatarPlaceholder"
                                        class="w-full h-full flex items-center justify-center text-5xl font-bold text-slate-300 bg-slate-50 group-hover:bg-slate-100 transition">
                                        {{ substr(Auth::user()->first_name, 0, 1) }}
                                    </div>
                                    {{-- عنصر img مخفي سيتم إظهاره عند اختيار صورة جديدة --}}
                                    <img id="avatarPreview"
                                        class="hidden w-full h-full object-cover transition duration-300 group-hover:scale-110 group-hover:opacity-75">
                                @endif

                                {{-- طبقة الكاميرا --}}
                                <div
                                    class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 bg-black/40 text-white backdrop-blur-sm">
                                    <i class="fa-solid fa-camera text-3xl mb-1"></i>
                                    <span class="text-xs font-bold uppercase tracking-wider">تغيير</span>
                                </div>
                            </div>

                            <div
                                class="absolute bottom-2 right-2 bg-slate-900 text-white w-10 h-10 rounded-full flex items-center justify-center border-4 border-white shadow-lg group-hover:scale-110 group-hover:bg-orange-600 transition duration-300">
                                <i class="fa-solid fa-pen text-sm"></i>
                            </div>
                        </div>

                        <input type="file" name="avatar" id="avatarInput" class="hidden" accept="image/*"
                            onchange="previewImage(event)">

                        <div class="mt-6 text-center">
                            <h3 class="text-2xl font-black text-slate-900">{{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}</h3>
                            <p class="text-sm font-bold text-gray-400 mt-1">{{ Auth::user()->email }}</p>
                            <span
                                class="inline-block mt-3 px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-xs font-bold border border-slate-200">
                                {{ Auth::user()->role === 'provider' ? 'مزود خدمة' : (Auth::user()->role === 'admin' ? 'مدير النظام' : 'مستأجر') }}
                            </span>
                        </div>
                    </div>

                    {{-- فاصل --}}
                    <div class="border-t border-gray-100 my-10 relative">
                        <span
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-4 text-gray-300 text-sm">
                            <i class="fa-solid fa-asterisk"></i>
                        </span>
                    </div>

                    {{-- 2. المعلومات الأساسية --}}
                    <div class="mb-12">
                        <h3 class="text-xl font-black text-slate-900 mb-8 flex items-center gap-3">
                            <span
                                class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg">
                                <i class="fa-regular fa-id-card"></i>
                            </span>
                            البيانات الشخصية
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- الاسم الأول --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700">الاسم الأول</label>
                                <div class="relative group">
                                    <input type="text" name="first_name"
                                        value="{{ old('first_name', $user->first_name) }}"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 pl-12 focus:bg-white focus:outline-none focus:border-slate-900 focus:ring-0 transition duration-300 font-bold text-slate-800 placeholder-gray-300">
                                    <i
                                        class="fa-regular fa-user absolute left-5 top-5 text-gray-400 group-focus-within:text-slate-900 transition-colors"></i>
                                </div>
                            </div>

                            {{-- الاسم الأخير --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700">الاسم الأخير</label>
                                <div class="relative group">
                                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 pl-12 focus:bg-white focus:outline-none focus:border-slate-900 focus:ring-0 transition duration-300 font-bold text-slate-800 placeholder-gray-300">
                                    <i
                                        class="fa-regular fa-user absolute left-5 top-5 text-gray-400 group-focus-within:text-slate-900 transition-colors"></i>
                                </div>
                            </div>

                            {{-- البريد --}}
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-slate-700">البريد الإلكتروني</label>
                                <div class="relative group">
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 pl-12 focus:bg-white focus:outline-none focus:border-slate-900 focus:ring-0 transition duration-300 font-bold text-slate-800 placeholder-gray-300">
                                    <i
                                        class="fa-regular fa-envelope absolute left-5 top-5 text-gray-400 group-focus-within:text-slate-900 transition-colors"></i>
                                </div>
                            </div>

                            {{-- الهاتف --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700">رقم الهاتف</label>
                                <div class="relative group">
                                    <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 pl-12 focus:bg-white focus:outline-none focus:border-slate-900 focus:ring-0 transition duration-300 font-bold text-slate-800 placeholder-gray-300 text-left dir-ltr"
                                        placeholder="77xxxxxxx">
                                    <i
                                        class="fa-solid fa-phone absolute left-5 top-5 text-gray-400 group-focus-within:text-slate-900 transition-colors"></i>
                                </div>
                            </div>

                            {{-- المدينة --}}
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700">المدينة</label>
                                <div class="relative group">
                                    <select name="city"
                                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 pl-12 focus:bg-white focus:outline-none focus:border-slate-900 focus:ring-0 transition duration-300 font-bold text-slate-800 appearance-none cursor-pointer">
                                        <option value="صنعاء" {{ $user->city == 'صنعاء' ? 'selected' : '' }}>صنعاء
                                        </option>
                                        <option value="عدن" {{ $user->city == 'عدن' ? 'selected' : '' }}>عدن</option>
                                        <option value="تعز" {{ $user->city == 'تعز' ? 'selected' : '' }}>تعز</option>
                                        <option value="حضرموت" {{ $user->city == 'حضرموت' ? 'selected' : '' }}>حضرموت
                                        </option>
                                        <option value="إب" {{ $user->city == 'إب' ? 'selected' : '' }}>إب</option>
                                    </select>
                                    <i
                                        class="fa-solid fa-location-dot absolute left-5 top-5 text-gray-400 group-focus-within:text-slate-900 transition-colors pointer-events-none"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. تغيير كلمة المرور --}}
                    <div class="bg-slate-50 rounded-3xl p-8 border border-slate-100">
                        <h3 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3">
                            <span
                                class="w-10 h-10 rounded-xl bg-white text-slate-900 flex items-center justify-center text-lg border border-slate-200">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            الأمان وكلمة المرور
                            <span
                                class="text-xs font-normal text-gray-400 mr-auto bg-white px-3 py-1 rounded-full border border-gray-200">اختياري</span>
                        </h3>

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-slate-700">كلمة المرور الحالية</label>
                                <div class="relative group">
                                    <input type="password" name="current_password" autocomplete="current-password"
                                        class="w-full bg-white border-2 border-gray-200 rounded-2xl px-5 py-4 pl-12 focus:outline-none focus:border-orange-500 focus:ring-0 transition duration-300 font-bold text-slate-800 placeholder-gray-300">
                                    <i
                                        class="fa-solid fa-key absolute left-5 top-5 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                                </div>
                                @error('current_password')
                                    <span class="text-red-500 text-xs font-bold block mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-slate-700">كلمة المرور الجديدة</label>
                                    <div class="relative group">
                                        <input type="password" name="password" autocomplete="new-password"
                                            class="w-full bg-white border-2 border-gray-200 rounded-2xl px-5 py-4 pl-12 focus:outline-none focus:border-orange-500 focus:ring-0 transition duration-300 font-bold text-slate-800 placeholder-gray-300">
                                        <i
                                            class="fa-solid fa-lock absolute left-5 top-5 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                                    </div>
                                    @error('password')
                                        <span class="text-red-500 text-xs font-bold block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-slate-700">تأكيد الجديدة</label>
                                    <div class="relative group">
                                        <input type="password" name="password_confirmation" autocomplete="new-password"
                                            class="w-full bg-white border-2 border-gray-200 rounded-2xl px-5 py-4 pl-12 focus:outline-none focus:border-orange-500 focus:ring-0 transition duration-300 font-bold text-slate-800 placeholder-gray-300">
                                        <i
                                            class="fa-solid fa-check-double absolute left-5 top-5 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- أزرار التحكم --}}
                    <div
                        class="flex flex-col-reverse md:flex-row items-center justify-between gap-4 pt-10 mt-6 border-t border-gray-100">
                        <a href="{{ route('home') }}"
                            class="text-slate-500 font-bold hover:text-slate-900 transition flex items-center gap-2 py-3">
                            <i class="fa-solid fa-arrow-right"></i> إلغاء العودة
                        </a>

                        <button type="submit"
                            class="w-full md:w-auto bg-slate-900 text-white px-10 py-4 rounded-2xl font-black hover:bg-orange-600 transition-all duration-300 shadow-xl shadow-slate-900/20 hover:shadow-orange-500/30 transform hover:-translate-y-1 flex items-center justify-center gap-3">
                            <i class="fa-regular fa-floppy-disk text-lg"></i> حفظ التغييرات
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imgElement = document.getElementById('avatarPreview');
                const placeholderElement = document.getElementById('avatarPlaceholder');

                // تحديث مصدر الصورة
                imgElement.src = reader.result;
                imgElement.classList.remove('hidden'); // إظهار الصورة

                // إخفاء الرمز الافتراضي (الحرف الأول) إن وجد
                if (placeholderElement) {
                    placeholderElement.style.display = 'none';
                }
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>

@endsection
