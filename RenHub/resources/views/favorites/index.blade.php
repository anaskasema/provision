@extends('layouts.app')

@section('title', 'المفضلة')

@section('content')

    {{-- الهيدر الكحلي الفخم --}}
    <div class="relative bg-slate-900 py-20 pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>

        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none">
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <div
                class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-white/5 backdrop-blur-md border border-white/20 mb-6 text-red-500 shadow-2xl group">
                <i class="fa-solid fa-heart text-4xl group-hover:scale-110 transition-transform duration-300"></i>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4">قائمة رغباتي</h1>
            <p class="text-slate-400 max-w-xl mx-auto text-lg leading-relaxed">
                المعدات التي قمت بحفظها للرجوع إليها لاحقاً.
            </p>
        </div>
    </div>

    {{-- قسم المحتوى --}}
    <div class="container mx-auto px-4 -mt-20 relative z-20 pb-20">

        @if ($favorites->count() > 0)

            <div class="flex items-center gap-2 mb-6 text-white/80 font-bold text-sm px-2">
                <i class="fa-solid fa-list-check"></i> لديك {{ $favorites->count() }} معدات محفوظة
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($favorites as $item)
                    @php
                        $images = $item->images;
                        if (is_string($images)) {
                            $images = json_decode($images, true);
                        }
                        $mainImage = !empty($images) ? asset($images[0]) : 'https://via.placeholder.com/300';
                    @endphp

                    {{-- بطاقة المعدة --}}
                    <div
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full relative">

                        {{-- 🔥 التعديل هنا: نمرر $item لضمان استخدام الـ Slug وعدم ظهور 404 🔥 --}}
                        <form action="{{ route('favorites.toggle', $item) }}" method="POST"
                            class="absolute top-3 right-3 z-20">
                            @csrf
                            <button type="submit"
                                class="w-8 h-8 rounded-full bg-white/90 backdrop-blur text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center shadow-md transition">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </form>

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
                                    عرض التفاصيل
                                </a>

                                {{-- 🔥 التعديل هنا أيضاً: نمرر $item 🔥 --}}
                                <form action="{{ route('favorites.toggle', $item) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition border border-red-100"
                                        title="إزالة">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- الترقيم --}}
            <div class="mt-12 flex justify-center">
                @if (method_exists($favorites, 'links'))
                    {{ $favorites->links() }}
                @endif
            </div>
        @else
            {{-- الحالة الفارغة --}}
            <div
                class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 p-16 text-center max-w-2xl mx-auto mt-10">
                <div
                    class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300 border-4 border-slate-100">
                    <i class="fa-regular fa-heart text-5xl"></i>
                </div>

                <h3 class="text-2xl font-black text-slate-900 mb-3">القائمة فارغة حالياً</h3>
                <p class="text-gray-500 mb-8 leading-relaxed text-sm">
                    تصفح السوق وأضف ما يعجبك لتعود إليه بسهولة لاحقاً.
                </p>

                <a href="{{ route('items.index') }}"
                    class="inline-flex items-center gap-2 bg-slate-900 text-white px-8 py-4 rounded-xl font-bold hover:bg-orange-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                    <i class="fa-solid fa-magnifying-glass"></i> تصفح المعدات
                </a>
            </div>
        @endif

    </div>

@endsection
