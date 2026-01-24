@extends('layouts.app')

@section('title', 'نسيت كلمة المرور')

@section('content')
    <div class="min-h-screen flex bg-white overflow-hidden">

        {{-- القسم الأيمن: الفورم --}}
        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white relative z-10">
            <div class="mx-auto w-full max-w-sm lg:w-96">

                <div class="text-center lg:text-right mb-10">
                    <h2 class="text-3xl font-black text-slate-900 mb-2">نسيت كلمة المرور؟</h2>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        لا تقلق، يحدث ذلك للجميع. فقط أدخل بريدك الإلكتروني وسنرسل لك رابطاً لاختيار كلمة مرور جديدة.
                    </p>
                </div>

                {{-- رسالة النجاح (تم التعديل لتظهر بالعربي) --}}
           {{-- رسالة النجاح --}}
                @if (session('status'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-bold flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        {{-- تعديل نهائي: كتابة النص العربي مباشرة لأن الرسالة تعني نجاح الإرسال دوماً --}}
                        <span>تم إرسال رابط استعادة كلمة المرور إلى بريدك الإلكتروني!</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm font-bold">
                        <ul class="list-disc list-inside text-xs opacity-80">
                            @foreach ($errors->all() as $error)
                                {{-- ترجمة يدوية سريعة لرسالة الخطأ الشائعة --}}
                                <li>{{ $error == "We can't find a user with that email address." ? 'لم نجد حساباً مسجلاً بهذا البريد الإلكتروني.' : $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- البريد الإلكتروني --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">البريد الإلكتروني</label>
                        <div class="relative group">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                autofocus
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-4 py-3.5 pl-10 focus:outline-none focus:bg-white focus:border-orange-500 transition font-bold text-slate-800 placeholder-gray-400 group-hover:border-gray-200"
                                placeholder="name@example.com">
                            <i
                                class="fa-regular fa-envelope absolute left-4 top-4 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    {{-- زر الإرسال --}}
                    <button type="submit"
                        class="w-full bg-slate-900 text-white px-8 py-4 rounded-2xl font-black text-lg hover:bg-orange-600 transition-all duration-300 shadow-xl hover:shadow-orange-500/20 transform hover:-translate-y-1 flex items-center justify-center gap-3">
                        إرسال رابط الاستعادة <i class="fa-solid fa-paper-plane mt-1"></i>
                    </button>
                </form>

                {{-- زر العودة --}}
                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-slate-900 transition">
                        <i class="fa-solid fa-arrow-right"></i> العودة لتسجيل الدخول
                    </a>
                </div>

            </div>
        </div>

      {{-- القسم الأيسر: الصورة (كما طلبت تماماً) --}}

        <div class="hidden lg:block relative w-0 flex-1 bg-primary-DEFAULT">

            <div class="absolute inset-0 bg-gradient-to-bl from-primary-DEFAULT to-gray-900 opacity-80 z-10"></div>

            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/login.png') }}"

                alt="Login Background">

        </div>
@endsection
