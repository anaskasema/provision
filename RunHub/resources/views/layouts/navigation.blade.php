<nav x-data="{ open: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
    :class="{ 'bg-white/80 backdrop-blur-md shadow-md': scrolled, 'bg-white border-b border-gray-100': !scrolled }"
    class="sticky top-0 z-50 transition-all duration-300 w-full">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            {{-- الشعار --}}
            <div class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="flex-shrink-0 group">
                    <img src="{{ asset('images/logo.png') }}" alt="RentHub"
                        class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110">
                </a>

                {{-- روابط سطح المكتب --}}
                <div class="hidden sm:flex space-x-2 space-x-reverse">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                        class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('home') ? 'bg-orange-50 text-orange-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-house"></i> الرئيسية
                    </x-nav-link>

                    <x-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')"
                        class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('items.index') ? 'bg-orange-50 text-orange-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-layer-group"></i> المعدات
                    </x-nav-link>

                    <x-nav-link :href="route('pages.contact')" :active="request()->routeIs('pages.contact')"
                        class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('pages.contact') ? 'bg-orange-50 text-orange-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                        <i class="fa-solid fa-envelope"></i> اتصل بنا
                    </x-nav-link>

                    @if (Auth::check() && (Auth::user()->role === 'provider' || Auth::user()->role === 'admin'))
                        <x-nav-link :href="route('provider.dashboard')" :active="request()->routeIs('provider.dashboard')"
                            class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('provider.dashboard') ? 'bg-orange-50 text-orange-600' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-store"></i> لوحتي
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- الإجراءات (يمين) --}}
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-3">
                @auth
                    @if (Auth::user()->role == 'provider' || Auth::user()->role == 'admin')
                        <a href="{{ route('items.create') }}"
                            class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-orange-600 transition-colors shadow-lg shadow-slate-900/20 flex items-center gap-2 transform hover:-translate-y-0.5 active:scale-95 duration-200">
                            <i class="fa-solid fa-plus"></i> <span>أضف معدة</span>
                        </a>
                    @endif

                    {{-- قائمة المستخدم --}}
                    <x-dropdown align="left" width="56">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-3 pl-1 pr-1 py-1 border border-gray-100 rounded-full hover:bg-gray-50 transition ml-2 group bg-white shadow-sm">
                                @if (Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}"
                                        class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm">
                                @else
                                    <div
                                        class="w-9 h-9 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-sm border-2 border-white shadow-sm">
                                        {{ substr(Auth::user()->first_name, 0, 1) }}
                                    </div>
                                @endif
                                <div class="hidden md:block text-right pr-2">
                                    <span
                                        class="block text-xs font-bold text-slate-700 group-hover:text-orange-600 transition">{{ Auth::user()->first_name }}</span>
                                </div>
                                <i
                                    class="fa-solid fa-chevron-down text-[10px] text-gray-400 ml-2 group-hover:text-orange-500 transition px-2"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 bg-gray-50/50 border-b border-gray-100">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">حساب
                                    {{ Auth::user()->role === 'provider' ? 'مزود' : (Auth::user()->role === 'admin' ? 'مدير' : 'مستأجر') }}
                                </p>
                                <p class="text-xs font-bold text-slate-800 truncate mt-1">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="py-1">
                                <x-dropdown-link :href="route('dashboard')">
                                    <i class="fa-solid fa-box-open ml-2 text-slate-400 w-5"></i> حجوزاتي
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('favorites.index')">
                                    <i class="fa-solid fa-heart ml-2 text-red-400 w-5"></i> المفضلة
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    <i class="fa-solid fa-user-gear ml-2 text-slate-400 w-5"></i> الإعدادات
                                </x-dropdown-link>
                            </div>

                            @if (Auth::user()->role === 'admin')
                                <div class="border-t border-gray-100 my-1"></div>
                                <x-dropdown-link :href="route('admin.dashboard')" class="text-red-600 font-bold hover:bg-red-50">
                                    <i class="fa-solid fa-shield-halved ml-2 w-5"></i> الإدارة
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-500 hover:bg-red-50">
                                    <i class="fa-solid fa-arrow-right-from-bracket ml-2 w-5"></i> خروج
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                        class="text-slate-600 font-bold hover:text-slate-900 transition px-4 text-sm">دخول</a>
                    <a href="{{ route('register') }}"
                        class="bg-orange-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-orange-700 transition shadow-lg shadow-orange-600/20 transform hover:-translate-y-0.5">حساب
                        جديد</a>
                @endauth
            </div>

            {{-- زر قائمة الموبايل --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-orange-600 hover:bg-orange-50 focus:outline-none transition duration-150 ease-in-out">
                    <i class="fa-solid fa-bars text-xl" :class="{ 'hidden': open, 'inline-flex': !open }"></i>
                    <i class="fa-solid fa-xmark text-xl" :class="{ 'hidden': !open, 'inline-flex': open }"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- قائمة الموبايل المنسدلة --}}
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white/95 backdrop-blur-xl border-t border-gray-100 shadow-2xl absolute w-full left-0 top-20 z-40">
        <div class="pt-4 pb-4 space-y-2 px-4">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">الرئيسية</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('items.index')" :active="request()->routeIs('items.index')">تصفح المعدات</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pages.contact')" :active="request()->routeIs('pages.contact')">اتصل بنا</x-responsive-nav-link>

            @if (Auth::check() && (Auth::user()->role === 'provider' || Auth::user()->role === 'admin'))
                <div class="border-t border-gray-100 my-2"></div>
                <x-responsive-nav-link :href="route('provider.dashboard')" :active="request()->routeIs('provider.dashboard')" class="text-orange-600">لوحة
                    التحكم</x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-6 border-t border-gray-100 bg-gray-50/50 px-4">
            @auth
                <div class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center font-bold">
                        {{ substr(Auth::user()->first_name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">{{ Auth::user()->first_name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('dashboard') }}"
                        class="bg-white border border-gray-200 py-2.5 rounded-xl text-center text-sm font-bold text-slate-700 hover:bg-slate-50">حجوزاتي</a>
                    <a href="{{ route('profile.edit') }}"
                        class="bg-white border border-gray-200 py-2.5 rounded-xl text-center text-sm font-bold text-slate-700 hover:bg-slate-50">الإعدادات</a>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit"
                        class="w-full bg-red-50 text-red-600 py-2.5 rounded-xl text-sm font-bold hover:bg-red-100 transition">تسجيل
                        الخروج</button>
                </form>
            @else
                <div class="flex flex-col gap-3">
                    <a href="{{ route('login') }}"
                        class="w-full bg-white border border-gray-200 py-3 rounded-xl text-center text-slate-800 font-bold shadow-sm">تسجيل
                        الدخول</a>
                    <a href="{{ route('register') }}"
                        class="w-full bg-orange-600 text-white py-3 rounded-xl text-center font-bold shadow-lg shadow-orange-600/20">إنشاء
                        حساب</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
