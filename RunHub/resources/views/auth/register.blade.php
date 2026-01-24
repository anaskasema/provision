@extends('layouts.app')

@section('title', 'إنشاء حساب جديد')

@section('content')
    <div class="min-h-screen flex bg-white overflow-hidden">

        {{-- القسم الأيمن: نموذج التسجيل --}}
        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white relative z-10">
            <div class="mx-auto w-full max-w-sm lg:w-[30rem]">

                <div class="text-center lg:text-right mb-8">
                    <h2 class="text-4xl font-black text-slate-900 mb-2">انضم إلى عائلتنا</h2>
                    <p class="text-sm text-gray-500">
                        ابدأ رحلتك في RentHub اليوم. هل لديك حساب بالفعل؟
                        <a href="{{ route('login') }}"
                            class="font-bold text-orange-600 hover:text-orange-700 transition underline decoration-2 underline-offset-4 decoration-orange-200">
                            سجل دخولك
                        </a>
                    </p>
                </div>

                {{-- عرض الأخطاء --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-bold">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> يرجى تصحيح الأخطاء التالية:
                        </div>
                        <ul class="list-disc list-inside text-xs opacity-80">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- 1. اختيار الدور (بتصميم الكروت مع تركيز برتقالي) --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">كيف تود استخدام المنصة؟</label>
                        <div class="grid grid-cols-2 gap-4">
                            {{-- خيار مستأجر --}}
                            <label class="cursor-pointer relative">
                                <input type="radio" name="role" value="user" class="peer sr-only" checked>
                                <div
                                    class="p-4 rounded-2xl border-2 border-gray-100 bg-white text-center hover:border-orange-200 transition-all duration-300 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-700 shadow-sm">
                                    <div
                                        class="w-10 h-10 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2 peer-checked:bg-orange-200 peer-checked:text-orange-600 text-gray-400 transition-colors">
                                        <i class="fa-solid fa-user text-lg"></i>
                                    </div>
                                    <span class="font-bold text-sm block">مستأجر</span>
                                    <span class="text-[10px] text-gray-400 block mt-1">أبحث عن معدات</span>
                                </div>
                                <div
                                    class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-orange-500 transition-opacity">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                            </label>

                            {{-- خيار مزود خدمة --}}
                            <label class="cursor-pointer relative">
                                <input type="radio" name="role" value="provider" class="peer sr-only">
                                <div
                                    class="p-4 rounded-2xl border-2 border-gray-100 bg-white text-center hover:border-orange-200 transition-all duration-300 peer-checked:border-orange-500 peer-checked:bg-orange-50 peer-checked:text-orange-700 shadow-sm">
                                    <div
                                        class="w-10 h-10 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-2 peer-checked:bg-orange-200 peer-checked:text-orange-600 text-gray-400 transition-colors">
                                        <i class="fa-solid fa-shop text-lg"></i>
                                    </div>
                                    <span class="font-bold text-sm block">مزود خدمة</span>
                                    <span class="text-[10px] text-gray-400 block mt-1">أمتلك معدات للتأجير</span>
                                </div>
                                <div
                                    class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 text-orange-500 transition-opacity">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- 2. الاسم --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">الاسم الأول</label>
                            <input type="text" name="first_name" required value="{{ old('first_name') }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">الاسم الأخير</label>
                            <input type="text" name="last_name" required value="{{ old('last_name') }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400">
                        </div>
                    </div>

                    {{-- 3. البريد --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">البريد الإلكتروني</label>
                        <div class="relative group">
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400"
                                placeholder="name@example.com">
                            <i
                                class="fa-regular fa-envelope absolute left-4 top-4 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    {{-- 4. الهاتف --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">رقم الهاتف (للتواصل والعقود)</label>
                        <div class="relative group">
                            <input type="tel" name="phone" required value="{{ old('phone') }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400 text-left dir-ltr"
                                placeholder="77xxxxxxx">
                            <i
                                class="fa-solid fa-phone absolute left-4 top-4 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    {{-- 5. كلمات المرور --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">كلمة المرور</label>
                            <div class="relative group">
                                <input type="password" name="password" required
                                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400">
                                <i
                                    class="fa-solid fa-lock absolute left-4 top-4 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">تأكيد المرور</label>
                            <div class="relative group">
                                <input type="password" name="password_confirmation" required
                                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400">
                                <i
                                    class="fa-solid fa-check-double absolute left-4 top-4 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                        </div>
                    </div>

                    {{-- تنبيه الدقة --}}
                    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 flex gap-3 items-start">
                        <i class="fa-solid fa-triangle-exclamation text-yellow-600 mt-1"></i>
                        <p class="text-xs text-yellow-700 font-bold leading-relaxed">
                            تنبيه هام: يرجى التأكد من صحة الاسم ورقم الهاتف، حيث سيتم اعتمادهما تلقائياً في العقود
                            الإلكترونية.
                        </p>
                    </div>

                    {{-- زر التسجيل --}}
                    <button type="submit"
                        class="w-full bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-lg hover:bg-orange-600 transition-all duration-300 shadow-xl hover:shadow-orange-500/20 transform hover:-translate-y-1 flex items-center justify-center gap-2 mt-4">
                        إتمام التسجيل <i class="fa-solid fa-check-circle"></i>
                    </button>
                </form>
            </div>
        </div>

     <div class="hidden lg:block relative w-0 flex-1 bg-primary-DEFAULT">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-DEFAULT to-gray-900 opacity-80 z-10"></div>
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/register.png') }}"
                alt="Register Background">

        </div>
    </div>
@endsection
