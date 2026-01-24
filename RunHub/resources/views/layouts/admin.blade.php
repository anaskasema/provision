<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم | RentHub</title>

    {{-- الخطوط والأيقونات --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- مكتبة SweetAlert2 (للتنبيهات الجميلة) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- ملفات الستايل --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Almarai', sans-serif;
            background-color: #f8fafc;
        }

        /* سكرول بار نحيف كحلي */
        aside::-webkit-scrollbar {
            width: 3px;
        }

        aside::-webkit-scrollbar-thumb {
            background: #1e293b;
            border-radius: 10px;
        }

        /* العنصر النشط: كحلي هادئ مع لمسة برتقالية */
        .nav-active {
            background-color: #0f172a;
            color: #ffffff !important;
            border-right: 4px solid #f97316;
            font-weight: 700;
        }

        .nav-item {
            transition: all 0.2s ease;
            margin: 0 10px;
            color: #64748b;
        }

        .nav-item:hover:not(.nav-active) {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        .text-navy {
            color: #0f172a;
        }

        .bg-navy {
            background-color: #0f172a;
        }
    </style>
</head>

<body class="text-slate-700 antialiased">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

        {{-- ================= القائمة الجانبية (Sidebar) ================= --}}
        <aside
            class="fixed inset-y-0 right-0 z-50 w-64 bg-white transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col border-l border-slate-100 shadow-sm"
            :class="sidebarOpen ? 'translate-x-0' : 'translate-x-full md:translate-x-0'">

            {{-- الشعار - RentHub بالكحلي --}}
            <div class="h-20 flex items-center gap-3 px-6 border-b border-slate-50">
                <div class="w-9 h-9 bg-navy rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fa-solid fa-bolt-lightning text-xs"></i>
                </div>
                <h1 class="font-black text-xl tracking-tight text-navy">Rent<span class="text-orange-500">Hub</span>
                </h1>
            </div>

            {{-- روابط القائمة --}}
            <nav class="flex-1 overflow-y-auto py-6 space-y-1">

                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'nav-active' : '' }}">
                    <i class="fa-solid fa-grip-vertical text-sm"></i>
                    <span class="text-sm">لوحة القيادة</span>
                </a>

                <div class="pt-6 pb-2 px-6">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">الإدارة</span>
                </div>

                <a href="{{ route('admin.users') }}"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.users*') ? 'nav-active' : '' }}">
                    <i class="fa-solid fa-users text-sm"></i>
                    <span class="text-sm">المستخدمين</span>
                </a>

                <a href="{{ route('admin.bookings') }}"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.bookings*') ? 'nav-active' : '' }}">
                    <i class="fa-solid fa-calendar-check text-sm"></i>
                    <span class="text-sm">الحجوزات</span>
                </a>

                <div class="pt-6 pb-2 px-6">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">النظام</span>
                </div>

                <a href="{{ route('admin.messages') }}"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.messages') ? 'nav-active' : '' }}">
                    <i class="fa-solid fa-envelope text-sm"></i>
                    <span class="text-sm">الرسائل</span>
                </a>

                <a href="{{ route('admin.settings') }}"
                    class="nav-item flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.settings') ? 'nav-active' : '' }}">
                    <i class="fa-solid fa-sliders text-sm"></i>
                    <span class="text-sm">الإعدادات</span>
                </a>
            </nav>

            {{-- زر العودة للموقع --}}
            <div class="p-4 border-t border-slate-50">
                <a href="{{ route('home') }}"
                    class="flex items-center justify-center gap-2 w-full py-2.5 rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-navy transition text-xs font-bold">
                    <i class="fa-solid fa-arrow-right-from-bracket rotate-180"></i>
                    العودة للموقع
                </a>
            </div>
        </aside>

        {{-- خلفية الموبايل --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 bg-slate-900/20 backdrop-blur-sm z-40 md:hidden"></div>

        {{-- ================= المحتوى الرئيسي ================= --}}
        <main class="flex-1 overflow-y-auto flex flex-col">

            {{-- هيدر علوي مريح وكحلي النصوص --}}
            <header
                class="bg-white/80 backdrop-blur-md h-16 border-b border-slate-100 flex items-center justify-between px-8 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-slate-400 hover:text-navy">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                    <h2 class="text-sm font-bold text-navy">@yield('title')</h2>
                </div>

                <div class="flex items-center gap-3">
                    <div class="text-left hidden sm:block">
                        <span class="block text-xs font-bold text-navy">{{ Auth::user()->first_name }}</span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-slate-100 border border-slate-200 overflow-hidden shadow-sm">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="w-full h-full object-cover">
                        @else
                            <div
                                class="w-full h-full flex items-center justify-center text-[10px] font-bold text-slate-400">
                                {{ substr(Auth::user()->first_name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>
            </header>

            {{-- منطقة المحتوى --}}
            <div class="p-6 md:p-10 max-w-7xl w-full mx-auto">

                {{-- 🔥 استدعاء مكون التنبيهات (يغني عن التكرار) 🔥 --}}
                <x-alert />

                @yield('content')
            </div>

            <footer class="mt-auto py-6 text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                RentHub &copy; {{ date('Y') }}
            </footer>
        </main>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html>
