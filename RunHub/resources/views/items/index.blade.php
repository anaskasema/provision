@extends('layouts.app')

@section('title', 'تصفح المعدات')

@section('content')

    {{-- الهيدر العلوي الملون --}}
    <div class="relative bg-slate-900 py-20 pb-28 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-6">
                    السوق <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-200">المفتوح</span>
                </h1>

                {{-- فورم البحث --}}
                <form action="{{ route('items.index') }}" method="GET"
                    class="relative group transform hover:scale-[1.01] transition duration-300">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('city'))
                        <input type="hidden" name="city" value="{{ request('city') }}">
                    @endif
                    @if (request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <div class="relative">
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="ابحث عن: دريل، كاميرا، سيارة..."
                            class="w-full h-16 pl-6 pr-16 rounded-2xl bg-white text-gray-800 placeholder-gray-400 text-lg focus:outline-none focus:ring-4 focus:ring-orange-500/30 shadow-2xl transition font-medium border-0">
                        <button type="submit"
                            class="absolute right-2 top-2 bottom-2 bg-orange-600 hover:bg-orange-700 text-white w-12 rounded-xl flex items-center justify-center transition shadow-lg">
                            <i class="fa-solid fa-magnifying-glass text-lg"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-12 relative z-20 pb-20">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- القائمة الجانبية (Filter) --}}
            <aside class="w-full lg:w-1/4">
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 sticky top-24 overflow-hidden">
                    <div class="p-5 bg-slate-900 text-white flex justify-between items-center">
                        <h3 class="font-bold text-lg flex items-center gap-2"><i
                                class="fa-solid fa-sliders text-orange-500"></i> تصفية النتائج</h3>
                        @if (request()->anyFilled(['q', 'category', 'city', 'sort']))
                            <a href="{{ route('items.index') }}"
                                class="text-xs font-bold text-red-400 hover:text-white transition bg-white/10 px-2 py-1 rounded flex items-center gap-1"><i
                                    class="fa-solid fa-rotate-left"></i> مسح</a>
                        @endif
                    </div>
                    <form action="{{ route('items.index') }}" method="GET" class="p-5" id="filterForm">
                        {{-- نفس كود الفلتر السابق --}}
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        @if (request('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif

                        <div class="mb-6">
                            <h4 class="font-bold text-xs text-gray-400 mb-3 uppercase tracking-wider">المدينة</h4>
                            <div class="relative">
                                <select name="city" onchange="this.form.submit()"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 pr-10 pl-4 text-sm font-bold text-gray-700 focus:outline-none focus:border-slate-900 focus:bg-white appearance-none cursor-pointer transition shadow-sm hover:border-orange-200">
                                    <option value="">📍 كل المدن</option>
                                    @foreach (['صنعاء', 'عدن', 'تعز', 'حضرموت', 'إب'] as $city)
                                        <option value="{{ $city }}"
                                            {{ request('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                    @endforeach
                                </select>
                                <i
                                    class="fa-solid fa-chevron-down absolute left-4 top-4 text-xs text-gray-400 pointer-events-none"></i>
                            </div>
                        </div>

                        <div class="mb-2">
                            <h4 class="font-bold text-xs text-gray-400 mb-3 uppercase tracking-wider">الفئات</h4>
                            <div class="flex flex-col gap-2">
                                <label class="cursor-pointer relative group">
                                    <input type="radio" name="category" value="" class="peer sr-only"
                                        {{ !request('category') ? 'checked' : '' }} onchange="this.form.submit()">
                                    <div
                                        class="w-full py-3 px-4 rounded-xl text-sm font-bold border border-gray-100 bg-gray-50 text-gray-600 group-hover:border-slate-300 transition-all duration-300 flex items-center justify-between peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 peer-checked:shadow-lg">
                                        <span class="flex items-center gap-2"><i
                                                class="fa-solid fa-layer-group text-orange-500 peer-checked:text-orange-500"></i>
                                            الكل</span>
                                        <i
                                            class="fa-solid fa-circle-check opacity-0 peer-checked:opacity-100 transition-opacity text-orange-500"></i>
                                    </div>
                                </label>
                                @foreach ($categories as $category)
                                    <label class="cursor-pointer relative group">
                                        <input type="radio" name="category" value="{{ $category->id }}"
                                            class="peer sr-only"
                                            {{ request('category') == $category->id ? 'checked' : '' }}
                                            onchange="this.form.submit()">
                                        <div
                                            class="w-full py-3 px-4 rounded-xl text-sm font-bold border border-gray-100 bg-gray-50 text-gray-600 group-hover:border-slate-300 transition-all duration-300 flex items-center justify-between peer-checked:bg-slate-900 peer-checked:text-white peer-checked:border-slate-900 peer-checked:shadow-lg">
                                            <span class="flex items-center gap-2"><i
                                                    class="fa-solid fa-angle-left text-gray-400 text-xs peer-checked:text-orange-500"></i>
                                                {{ $category->name }}</span>
                                            <i
                                                class="fa-solid fa-circle-check opacity-0 peer-checked:opacity-100 transition-opacity text-orange-500"></i>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </aside>

            {{-- المحتوى الرئيسي --}}
            <main class="w-full lg:w-3/4">

                {{-- شريط الترتيب --}}
                <div
                    class="flex flex-col sm:flex-row justify-between items-center mb-6 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-center gap-2 mb-4 sm:mb-0">
                        <div
                            class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-white text-xs shadow-md">
                            <i class="fa-solid fa-list"></i></div>
                        <span class="text-gray-600 font-bold text-sm">عدد النتائج: <span
                                class="text-orange-600">{{ $items->total() }}</span></span>
                    </div>
                    <form action="{{ route('items.index') }}" method="GET"
                        class="flex items-center gap-2 text-sm text-gray-500">
                        @if (request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}">
                        @endif
                        @if (request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if (request('city'))
                            <input type="hidden" name="city" value="{{ request('city') }}">
                        @endif
                        <label for="sort" class="font-bold text-gray-700 hidden sm:block">ترتيب حسب:</label>
                        <div class="relative">
                            <select name="sort" id="sort" onchange="this.form.submit()"
                                class="bg-gray-50 border border-gray-200 rounded-lg py-2 pr-8 pl-3 font-bold text-slate-900 cursor-pointer focus:outline-none focus:border-orange-500 appearance-none text-sm min-w-[150px] shadow-sm hover:border-orange-300 transition">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>الأحدث مضافاً
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>السعر:
                                    الأقل أولاً</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>السعر:
                                    الأعلى أولاً</option>
                            </select>
                            <i
                                class="fa-solid fa-arrow-down-short-wide absolute left-3 top-2.5 text-xs text-orange-500 pointer-events-none"></i>
                        </div>
                    </form>
                </div>

                @if ($items->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($items as $item)
                            @php
                                $images = $item->images;
                                if (is_string($images)) {
                                    $images = json_decode($images, true);
                                }
                                $mainImage = !empty($images) ? asset($images[0]) : 'https://via.placeholder.com/300';
                            @endphp

                            <div
                                class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full">
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
                                            غير متاح</div>
                                    @endif
                                </div>

                                <div class="p-5 flex-1 flex flex-col">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-bold text-slate-900 text-lg truncate flex-1">{{ $item->title }}
                                        </h3>
                                        <div class="flex text-orange-400 text-xs gap-0.5 mt-1">
                                            <i class="fa-solid fa-star"></i>
                                            <span class="text-slate-600 font-bold ml-1">{{ $item->rating() }}</span>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 mb-4 flex items-center gap-2">
                                        <i class="fa-solid fa-layer-group text-orange-500"></i>
                                        {{ $item->category->name }}
                                        <span class="text-gray-300">|</span>
                                        <i class="fa-solid fa-location-dot text-gray-400"></i> {{ $item->city }}
                                    </p>

                                    <div class="mt-auto border-t border-gray-50 pt-4 flex gap-2">
                                        <a href="{{ route('items.show', $item) }}"
                                            class="flex-1 bg-slate-900 text-white py-2.5 rounded-xl text-center text-sm font-bold hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">تفاصيل
                                            وحجز</a>

                                        {{-- 🔥 التعديل هنا: تمرير $item بدلاً من $item->id 🔥 --}}
                                        <form action="{{ route('favorites.toggle', $item) }}" method="POST"
                                            class="inline">
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
                    <div class="mt-16 flex justify-center">{{ $items->appends(request()->query())->links() }}</div>
                @else
                    {{-- الحالة الفارغة --}}
                    <div class="text-center py-24 bg-white rounded-3xl shadow-sm border border-gray-100">
                        <div class="relative w-32 h-32 mx-auto mb-6">
                            <div class="absolute inset-0 bg-gray-50 rounded-full animate-ping opacity-75"></div>
                            <div
                                class="relative bg-white w-full h-full rounded-full flex items-center justify-center border-4 border-gray-50 text-5xl text-gray-300">
                                <i class="fa-solid fa-folder-open"></i></div>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-800 mb-2">عذراً، لا توجد نتائج!</h3>
                        <p class="text-gray-500 mb-8 max-w-xs mx-auto leading-relaxed">لم نجد معدات تطابق خياراتك الحالية.
                        </p>
                        <a href="{{ route('items.index') }}"
                            class="inline-flex items-center gap-2 bg-slate-900 text-white px-8 py-3 rounded-xl font-bold hover:bg-slate-800 transition-all shadow-lg"><i
                                class="fa-solid fa-globe"></i> عرض كل شيء</a>
                    </div>
                @endif
            </main>
        </div>
    </div>
@endsection
