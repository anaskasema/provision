@extends('layouts.app')

@section('title', 'الرئيسية')

@section('content')

    {{-- ========================================== --}}
    {{-- 1. الهيدر الرئيسي --}}
    {{-- ========================================== --}}
    <section class="relative w-full bg-slate-900">

        {{-- الصورة --}}
        <img src="{{ asset('images/hero.png') }}" class="w-full h-auto block" alt="RentHub Hero">

        {{-- تدرج لوني --}}
        <div
            class="absolute bottom-0 left-0 w-full h-48 bg-gradient-to-t from-slate-900/90 to-transparent z-10 pointer-events-none">
        </div>

        {{-- شريط البحث --}}
        <div class="absolute bottom-8 left-0 w-full z-20 px-4">
            <div class="container mx-auto">
                <form action="{{ route('items.index') }}" method="GET"
                    class="bg-white p-3 rounded-2xl shadow-2xl shadow-black/20 max-w-4xl mx-auto md:mr-auto md:ml-0 flex flex-col md:flex-row gap-3 border border-gray-100">

                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none text-orange-500">
                            <i class="fa-solid fa-magnifying-glass text-xl"></i>
                        </div>
                        <input type="text" name="q" placeholder="ابحث عن: دريل، كاميرا، سيارة..."
                            class="w-full h-12 md:h-14 pr-14 pl-6 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-0 text-gray-800 placeholder-gray-400 text-base md:text-lg transition font-medium">
                    </div>

                    <div class="w-full md:w-1/4 relative">
                        <select name="city"
                            class="w-full h-12 md:h-14 px-4 pr-10 rounded-xl bg-gray-50 border-transparent focus:bg-white focus:border-orange-500 focus:ring-0 text-gray-700 cursor-pointer text-base appearance-none font-medium transition">
                            <option value="">📍 كل المدن</option>
                            <option value="صنعاء">صنعاء</option>
                            <option value="عدن">عدن</option>
                            <option value="تعز">تعز</option>
                        </select>
                        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-chevron-down text-sm"></i>
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-orange-600 text-white h-12 md:h-14 px-10 rounded-xl font-bold text-lg hover:bg-orange-700 transition-all shadow-lg flex items-center justify-center gap-2">
                        <span>بحث</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- 2. قسم التصنيفات --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-slate-50 relative">
        <div class="container mx-auto px-4">

            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                    تصفح حسب <span class="text-orange-600 relative inline-block">الفئة
                        <svg class="absolute w-full h-2 bottom-1 right-0 text-orange-200 -z-10" viewBox="0 0 100 10"
                            preserveAspectRatio="none">
                            <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none" />
                        </svg>
                    </span>
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg">استكشف مجموعة واسعة من الأقسام لتجد بالضبط ما تبحث عنه
                    لمشروعك القادم.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('items.index', ['category' => $category->id]) }}" class="group">
                        <div
                            class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-orange-500/10 transition-all duration-300 transform hover:-translate-y-2 flex flex-col items-center text-center h-full">
                            <div
                                class="w-16 h-16 mb-4 rounded-2xl bg-slate-50 text-slate-700 flex items-center justify-center text-3xl group-hover:bg-slate-900 group-hover:text-white transition-all duration-300">
                                <i class="{{ $category->icon }}"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-lg mb-1 group-hover:text-orange-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                            <span class="text-xs text-gray-400 group-hover:text-gray-500">تصفح الآن</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- 3. قسم خطوات العمل (معدل النصوص) --}}
    {{-- ========================================== --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="bg-slate-900 rounded-[3rem] p-10 md:p-16 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>

                <div class="relative z-10">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-extrabold text-white mb-4">كيف يعمل RentHub؟</h2>
                        <p class="text-slate-400">ثلاث خطوات بسيطة تفصلك عن استئجار ما تحتاج.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                        {{-- خطوة 1: ابحث --}}
                        <div class="relative group">
                            <div
                                class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 text-orange-500 text-3xl border border-white/10 shadow-lg group-hover:scale-110 transition duration-300">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">1. ابحث</h3>
                            <p class="text-slate-400 text-sm px-4 leading-relaxed">
                                تصفح آلاف المعدات المتوفرة في مدينتك، قارن المواصفات والأسعار، واختر الأنسب لمشروعك.
                            </p>

                            {{-- خط واصل --}}
                            <div
                                class="hidden md:block absolute top-10 left-0 w-full h-0.5 bg-gradient-to-l from-white/10 to-transparent -translate-x-1/2 -z-10">
                            </div>
                        </div>

                        {{-- خطوة 2: اطلب (تعديل النص) --}}
                        <div class="relative group">
                            <div
                                class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 text-orange-500 text-3xl border border-white/10 shadow-lg group-hover:scale-110 transition duration-300">
                                <i class="fa-regular fa-paper-plane"></i> {{-- تغيير الأيقونة لتناسب "إرسال طلب" --}}
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">2. اطلب</h3>
                            <p class="text-slate-400 text-sm px-4 leading-relaxed">
                                أرسل طلب الحجز وانتظر موافقة المزود.
                                <br>
                                <span class="text-orange-400 text-xs font-bold">(لا يتم الدفع أو مشاركة بيانات التواصل إلا
                                    بعد الموافقة لضمان الجدية)</span>
                            </p>

                            {{-- خط واصل --}}
                            <div
                                class="hidden md:block absolute top-10 left-0 w-full h-0.5 bg-gradient-to-l from-white/10 to-transparent -translate-x-1/2 -z-10">
                            </div>
                        </div>

                        {{-- خطوة 3: استلم (تعديل النص) --}}
                        <div class="group">
                            <div
                                class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6 text-orange-500 text-3xl border border-white/10 shadow-lg group-hover:scale-110 transition duration-300">
                                <i class="fa-solid fa-handshake-simple"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">3. تواصل واستلم</h3>
                            <p class="text-slate-400 text-sm px-4 leading-relaxed">
                                بعد الموافقة، سيظهر لك رقم المالك. تواصل معه لتنسيق الاستلام، دفع العربون، وتوقيع العقد.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================== --}}
    {{-- 4. قسم أحدث المعدات --}}
    {{-- ========================================== --}}
    <section class="py-24 bg-slate-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">وصل حديثاً للمنصة</h2>
                    <p class="text-gray-500">أحدث المعدات التي تم إضافتها وتوثيقها من قبل فريقنا.</p>
                </div>
                <a href="{{ route('items.index') }}"
                    class="text-orange-600 font-bold hover:text-slate-900 transition flex items-center gap-2">
                    تصفح الجميع <i class="fa-solid fa-arrow-left"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($latestItems as $item)
                    {{-- كرت المعدة الموحد --}}
                    @php
                        $images = $item->images;
                        if (is_string($images)) {
                            $images = json_decode($images, true);
                        }
                        $mainImage = !empty($images) ? asset($images[0]) : 'https://via.placeholder.com/300';
                    @endphp

                    <div
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full relative">
                        <div class="relative h-48 bg-gray-200 overflow-hidden">
                            <img src="{{ $mainImage }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                            <div
                                class="absolute bottom-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-xl text-sm font-bold text-slate-900 shadow-sm border border-gray-100">
                                {{ number_format($item->price_per_day) }} <span
                                    class="text-[10px] text-gray-500">YER/يوم</span>
                            </div>

                            @if (!$item->is_available)
                                <div
                                    class="absolute top-3 left-3 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded-lg shadow-sm">
                                    غير متاح
                                </div>
                            @endif
                        </div>

                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-slate-900 text-lg truncate flex-1">{{ $item->title }}</h3>
                                <div class="flex text-orange-400 text-xs gap-0.5 mt-1">
                                    <i class="fa-solid fa-star"></i>
                                    <span class="text-slate-600 font-bold ml-1">{{ $item->rating() }}</span>
                                </div>
                            </div>

                            <p class="text-xs text-gray-500 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-orange-500"></i> {{ $item->category->name }}
                                <span class="text-gray-300">|</span>
                                <i class="fa-solid fa-location-dot text-gray-400"></i> {{ $item->city }}
                            </p>

                            <div class="mt-auto border-t border-gray-50 pt-4 flex gap-2">
                                <a href="{{ route('items.show', $item) }}"
                                    class="flex-1 bg-slate-900 text-white py-2.5 rounded-xl text-center text-sm font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
                                    تفاصيل وحجز
                                </a>

                                <form action="{{ route('favorites.toggle', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-10 h-10 rounded-xl flex items-center justify-center transition border
                                        {{ Auth::check() && $item->isFavorited()
                                            ? 'bg-red-50 text-red-500 border-red-100 hover:bg-red-100'
                                            : 'bg-gray-50 text-gray-400 border-gray-100 hover:text-red-500 hover:bg-red-50' }}">
                                        <i
                                            class="{{ Auth::check() && $item->isFavorited() ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-20">
                <a href="{{ route('items.index') }}"
                    class="inline-flex items-center gap-3 bg-slate-900 text-white px-10 py-4 rounded-xl font-bold hover:bg-slate-800 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                    تصفح السوق بالكامل
                </a>
            </div>
        </div>
    </section>

@endsection
