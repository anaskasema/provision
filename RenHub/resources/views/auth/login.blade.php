@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
    <div class="min-h-screen flex bg-white overflow-hidden">

        {{-- القسم الأيمن: نموذج الدخول --}}
        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white relative z-10">
            <div class="mx-auto w-full max-w-sm lg:w-96">

                {{-- العنوان --}}
                <div class="text-center lg:text-right mb-10">
                    <h2 class="text-4xl font-black text-slate-900 mb-2">مرحباً بعودتك!</h2>
                    <p class="text-sm text-gray-500">
                        سعيدون برؤيتك مجدداً. الرجاء إدخال بياناتك للمتابعة.
                    </p>
                </div>

                {{-- التنبيهات (Flash Messages) --}}
                @if (session('status'))
                    <div
                        class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-bold flex items-center gap-2">
                        <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-bold flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-bold">
                        <div class="flex items-center gap-2 mb-1">
                            <i class="fa-solid fa-triangle-exclamation"></i> خطأ في البيانات:
                        </div>
                        <ul class="list-disc list-inside text-xs opacity-80">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- الفورم --}}
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- البريد الإلكتروني --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">البريد الإلكتروني</label>
                        <div class="relative group">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-4 py-3.5 pl-10 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400 group-hover:border-gray-200"
                                placeholder="name@example.com">
                            <i
                                class="fa-regular fa-envelope absolute left-4 top-4 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    {{-- كلمة المرور --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">كلمة المرور</label>
                        <div class="relative group">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-4 py-3.5 pl-10 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400 group-hover:border-gray-200"
                                placeholder="••••••••">
                            <i
                                class="fa-solid fa-lock absolute left-4 top-4 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    {{-- خيارات إضافية --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded cursor-pointer transition">
                            <label for="remember_me"
                                class="ml-2 block text-sm font-bold text-gray-600 cursor-pointer select-none">تذكرني</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-bold text-orange-600 hover:text-orange-700 transition">
                                نسيت كلمة المرور؟
                            </a>
                        @endif
                    </div>

                    {{-- زر الدخول --}}
                    <button type="submit"
                        class="w-full bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-lg hover:bg-orange-600 transition-all duration-300 shadow-xl hover:shadow-orange-500/20 transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        تسجيل الدخول <i class="fa-solid fa-arrow-left mt-1"></i>
                    </button>
                </form>

                {{-- رابط التسجيل --}}
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        ليس لديك حساب؟
                        <a href="{{ route('register') }}"
                            class="font-black text-slate-900 hover:text-orange-600 transition underline decoration-2 underline-offset-4 decoration-orange-200">
                            أنشئ حساباً جديداً
                        </a>
                    </p>
                </div>

            </div>
        </div>

        {{-- القسم الأيسر: الصورة (كما هي) --}}
          {{-- القسم الأيسر: الصورة (كما طلبت تماماً) --}}

        <div class="hidden lg:block relative w-0 flex-1 bg-primary-DEFAULT">

            <div class="absolute inset-0 bg-gradient-to-bl from-primary-DEFAULT to-gray-900 opacity-80 z-10"></div>

            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/login.png') }}"

                alt="Login Background">

        </div>
    </div>
@endsection
