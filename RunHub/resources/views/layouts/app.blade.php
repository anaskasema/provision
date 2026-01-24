<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RentHub | @yield('title', 'الرئيسية')</title>

    {{-- الخطوط --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">

    {{-- الأيقونات --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- مكتبة SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ملفات الستايل والسكربت --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-gray-50 font-sans text-gray-800 antialiased flex flex-col min-h-screen selection:bg-orange-500 selection:text-white">

    {{-- شريط التنقل العلوي --}}
    @include('layouts.navigation')

    {{-- المحتوى الرئيسي --}}
    <main class="flex-grow">
        <div class="container mx-auto px-4 mt-6">
            <x-alert />
        </div>

        @yield('content')
    </main>

    {{-- الفوتر --}}
    <footer class="bg-slate-900 text-white pt-20 pb-8 mt-auto border-t-4 border-orange-500 relative overflow-hidden">

        {{-- زخرفة خلفية --}}
        <div
            class="absolute top-0 left-0 w-full h-full opacity-5 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] pointer-events-none">
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">

                {{-- العمود 1: الشعار والنبذة --}}
                <div>
                    <div class="shrink-0 flex items-center mb-6">
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <img src="{{ asset('images/logo.png') }}" alt="RentHub" class="h-10 w-auto object-contain">
                        </a>
                    </div>
                    <p class="text-gray-400 text-sm leading-loose">
                        المنصة الأكثر تطوراً لتأجير المعدات في اليمن. نجمع بين الأمان، السرعة، والموثوقية في مكان واحد
                        لنخدم طموحك.
                    </p>
                </div>

                {{-- العمود 2: روابط هامة --}}
                <div>
                    <h4 class="font-bold text-lg mb-6 text-white relative inline-block">
                        روابط هامة
                        <span class="absolute -bottom-2 right-0 w-1/2 h-0.5 bg-orange-500 rounded-full"></span>
                    </h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li>
                            <a href="{{ route('home') }}"
                                class="hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center gap-2">
                                <i class="fa-solid fa-angle-left text-xs text-orange-500"></i> الرئيسية
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('items.index') }}"
                                class="hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center gap-2">
                                <i class="fa-solid fa-angle-left text-xs text-orange-500"></i> تصفح المعدات
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pages.about') }}"
                                class="hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center gap-2">
                                <i class="fa-solid fa-angle-left text-xs text-orange-500"></i> من نحن
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- العمود 3: مركز الدعم --}}
                <div>
                    <h4 class="font-bold text-lg mb-6 text-white relative inline-block">
                        مركز الدعم
                        <span class="absolute -bottom-2 right-0 w-1/2 h-0.5 bg-orange-500 rounded-full"></span>
                    </h4>
                    <ul class="space-y-4 text-sm text-gray-400">
                        <li>
                            <a href="{{ route('pages.terms') }}"
                                class="hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center gap-2">
                                <i class="fa-solid fa-angle-left text-xs text-orange-500"></i> الشروط والأحكام
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pages.privacy') }}"
                                class="hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center gap-2">
                                <i class="fa-solid fa-angle-left text-xs text-orange-500"></i> سياسة الخصوصية
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="hover:text-white hover:translate-x-1 transition-all duration-300 flex items-center gap-2">
                                <i class="fa-solid fa-angle-left text-xs text-orange-500"></i> الأسئلة الشائعة
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- العمود 4: تواصل معنا --}}
                <div>
                    <h4 class="font-bold text-lg mb-6 text-white relative inline-block">
                        تواصل معنا
                        <span class="absolute -bottom-2 right-0 w-1/2 h-0.5 bg-orange-500 rounded-full"></span>
                    </h4>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white hover:border-orange-600 transition-all duration-300 hover:-translate-y-1 shadow-lg">
                            <i class="fa-brands fa-facebook-f text-lg"></i>
                        </a>
                        <a href="#"
                            class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white hover:border-orange-600 transition-all duration-300 hover:-translate-y-1 shadow-lg">
                            <i class="fa-brands fa-twitter text-lg"></i>
                        </a>
                        <a href="#"
                            class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-400 hover:bg-orange-600 hover:text-white hover:border-orange-600 transition-all duration-300 hover:-translate-y-1 shadow-lg">
                            <i class="fa-brands fa-instagram text-lg"></i>
                        </a>
                    </div>
                    <div class="mt-6 text-sm text-gray-400 space-y-3">
                        <p class="flex items-center gap-3 hover:text-white transition">
                            <span
                                class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-orange-500"><i
                                    class="fa-solid fa-envelope"></i></span>
                            support@renthub.com
                        </p>
                        <p class="flex items-center gap-3 hover:text-white transition">
                            <span
                                class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-orange-500"><i
                                    class="fa-solid fa-phone"></i></span>
                            +967 777 000 000
                        </p>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">

                {{-- حقوق الموقع --}}
                <p class="text-gray-500 text-sm text-center md:text-right order-2 md:order-1">
                    &copy; {{ date('Y') }} <span class="text-white font-bold">RentHub</span>. جميع الحقوق محفوظة.
                </p>

                {{-- 🔥 توقيع الفريق (رابط فقط كما طلبت) 🔥 --}}
                <div class="order-1 md:order-2">
                    <p class="text-gray-600 text-xs font-medium tracking-wide">
                        Developed by
                        <a href="{{route('pages.team') }}"
                            class="text-orange-500 font-bold hover:text-white transition decoration-orange-500/50 underline-offset-4 hover:underline">
                            Sharab Software Team
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </footer>

</body>

</html>
