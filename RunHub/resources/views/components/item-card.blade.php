@props(['item'])

<div
    class="group relative bg-white rounded-[2rem] shadow-md hover:shadow-2xl hover:shadow-slate-900/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden h-full flex flex-col border border-gray-100">

    {{-- 1. قسم الصورة --}}
    <div class="relative h-72 overflow-hidden bg-gray-200">
        @php
            $rawImages = $item->images;
            $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;
            $images = is_array($images) ? $images : [];
            $image = !empty($images) ? $images[0] : 'https://via.placeholder.com/400x300';
        @endphp

        <img src="{{ $image }}" alt="{{ $item->title }}"
            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

        {{-- تدرج لوني كحلي غامق --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-transparent to-transparent opacity-80"></div>

        {{-- 🔥🔥🔥 زر المفضلة (تم التصحيح هنا) 🔥🔥🔥 --}}
        @auth
            {{-- التصحيح: استبدلنا $item->id بـ $item فقط --}}
            <form action="{{ route('favorites.toggle', $item) }}" method="POST" class="absolute top-4 left-4 z-30">
                @csrf
                <button type="submit"
                    class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 shadow-md backdrop-blur-sm border border-white/10
                    {{ $item->isFavorited() ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-black/30 text-white hover:bg-white hover:text-red-500' }}">
                    <i class="{{ $item->isFavorited() ? 'fa-solid' : 'fa-regular' }} fa-heart text-lg"></i>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
                class="absolute top-4 left-4 z-30 w-10 h-10 rounded-full bg-black/30 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white hover:text-red-500 transition shadow-md border border-white/10"
                title="سجل دخولك للإضافة للمفضلة">
                <i class="fa-regular fa-heart text-lg"></i>
            </a>
        @endauth

        {{-- التصنيف --}}
        <span
            class="absolute top-4 right-4 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm border border-white/10">
            {{ $item->category->name ?? 'عام' }}
        </span>

        {{-- السعر --}}
        <div class="absolute bottom-5 left-5 text-white z-10">
            <p class="flex items-baseline gap-1">
                <span class="text-3xl font-extrabold tracking-tight">{{ number_format($item->price_per_day) }}</span>
                <span class="text-xs font-bold opacity-90">{{ $item->currency }} / يوم</span>
            </p>
        </div>
    </div>

    {{-- 2. المحتوى --}}
    <div class="p-6 flex flex-col flex-grow relative bg-white">

        <div class="mb-6 flex-grow">
            {{-- العنوان --}}
            <h3 class="text-xl font-bold text-slate-900 line-clamp-1 mb-3">
                {{ $item->title }}
            </h3>
            <p class="text-gray-500 text-sm line-clamp-2 leading-relaxed font-medium">
                {{ Str::limit($item->description, 90) }}
            </p>
        </div>

        <div class="flex items-center justify-between mb-6">
            <div
                class="flex items-center gap-2 text-xs text-gray-600 bg-gray-50 px-3 py-1.5 rounded-full font-bold border border-gray-100">
                <i class="fa-solid fa-location-dot text-slate-900"></i>
                {{ $item->city }}
            </div>

            <div class="flex items-center gap-1 font-bold text-sm">
                <i class="fa-solid fa-star text-yellow-400"></i>
                <span class="text-gray-800">{{ $item->rating() }}</span>
            </div>
        </div>

        {{-- زر الإجراء --}}
        <a href="{{ route('items.show', $item) }}"
            class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl font-bold text-sm shadow-md transition-all duration-300
            
            bg-slate-900 text-white border border-transparent
            hover:bg-slate-800 hover:shadow-lg hover:-translate-y-1
            
            group/btn">

            <span>عرض التفاصيل</span>
            <i class="fa-solid fa-arrow-left transform group-hover/btn:-translate-x-1 transition-transform text-xs"></i>
        </a>
    </div>
</div>
