@extends('layouts.admin')

@section('title', 'سجل الحجوزات')

@section('content')

    {{-- ========================================================= --}}
    {{-- 1. الهيدر الكحلي الفخم (Hero Section) --}}
    {{-- ========================================================= --}}
    <div class="relative bg-slate-900 py-12 pb-28 rounded-3xl overflow-hidden shadow-lg mx-4 mt-4">
        {{-- الخلفية والنقشات --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none">
        </div>

        <div class="relative z-10 px-8 flex flex-col md:flex-row justify-between items-end gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-2 flex items-center gap-3">
                    <i class="fa-solid fa-calendar-check text-orange-500"></i> سجل الحجوزات
                </h1>
                <p class="text-slate-400">مراقبة وتتبع كافة عمليات التأجير والطلبات في المنصة.</p>
                <div
                    class="mt-4 inline-flex items-center gap-2 bg-slate-800/80 backdrop-blur border border-slate-700 rounded-full px-4 py-1.5 text-xs font-bold text-white shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span>
                    إجمالي الحجوزات: {{ $bookings->total() }}
                </div>
            </div>

            {{-- الفلتر والبحث --}}
            <form action="{{ route('admin.bookings') }}" method="GET"
                class="w-full md:w-auto flex flex-col md:flex-row gap-3">

                {{-- البحث --}}
                <div class="relative group min-w-[200px]">
                    <div
                        class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400 group-hover:text-orange-500 transition-colors">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="رقم الحجز، اسم المستأجر..."
                        class="w-full bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-2xl py-3.5 pr-10 pl-4 text-sm font-bold focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:bg-slate-800 placeholder-slate-500 transition-all shadow-xl">
                </div>

                {{-- فلتر الحالة --}}
                <div class="relative group min-w-[220px]">
                    <div
                        class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-orange-500 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <select name="status" onchange="this.form.submit()"
                        class="w-full bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-2xl py-3.5 pr-12 pl-10 text-sm font-black focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:bg-slate-800 appearance-none cursor-pointer transition-all duration-300 shadow-xl">
                        <option value="all" class="bg-slate-900">الكل (جميع الحالات)</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }} class="bg-slate-900">
                            🕒 معلق (Pending)</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}
                            class="bg-slate-900">✅ مؤكد (Confirmed)</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}
                            class="bg-slate-900">⭐ مكتمل (Completed)</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}
                            class="bg-slate-900">❌ ملغي (Cancelled)</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }} class="bg-slate-900">💳
                            غير مدفوع (Unpaid)</option>
                    </select>
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- 2. الجدول المتداخل (-mt-20) --}}
    {{-- ========================================================= --}}
    <div class="px-4 -mt-20 relative z-20 pb-20">
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-right text-sm">
                    <thead
                        class="bg-slate-50/50 text-slate-500 font-extrabold border-b border-slate-100 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="p-6">المستأجر</th>
                            <th class="p-6">المعدة / المالك</th>
                            <th class="p-6 text-center">الفترة</th>
                            <th class="p-6">الإجمالي</th>
                            <th class="p-6 text-center">الحالة</th>
                            {{-- ❌ تم حذف عمود الإجراءات بالكامل كما طلبت --}}
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-orange-50/10 transition duration-200 group">

                                {{-- المستأجر --}}
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center font-bold text-slate-500 border border-slate-200 shadow-sm group-hover:bg-white transition-colors">
                                            {{ substr($booking->user->first_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.users.show', $booking->user_id) }}"
                                                class="font-bold text-slate-900 hover:text-orange-600 transition block text-base">
                                                {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                            </a>
                                            <span
                                                class="text-[10px] text-slate-400 font-bold bg-slate-50 px-2 py-0.5 rounded border border-slate-100 mt-1 inline-block uppercase">رقم
                                                الحجز #{{ $booking->id }}</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- المعدة والمالك --}}
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        @if ($booking->item)
                                            <div
                                                class="w-12 h-12 rounded-xl overflow-hidden shadow-sm border border-slate-200 shrink-0">
                                                @php
                                                    $images = is_string($booking->item->images)
                                                        ? json_decode($booking->item->images, true)
                                                        : $booking->item->images;
                                                    $thumb = is_array($images) ? $images[0] ?? '' : '';
                                                @endphp
                                                <img src="{{ $thumb ?: 'https://via.placeholder.com/100' }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                {{-- ✅ تم التعديل: إزالة الرابط وجعله نصاً عادياً لحل مشكلة "غير موجود" --}}
                                                <span class="font-bold text-slate-800 block">
                                                    {{ $booking->item->title }}
                                                </span>

                                                <a href="{{ route('admin.users.show', $booking->item->user_id) }}"
                                                    class="text-[11px] font-bold text-slate-400 hover:text-orange-600 transition flex items-center gap-1 mt-1">
                                                    <i class="fa-solid fa-user-tie text-[9px]"></i> المالك:
                                                    {{ $booking->item->user->first_name ?? 'غير معروف' }}
                                                </a>
                                            </div>
                                        @else
                                            <span
                                                class="text-red-500 bg-red-50 px-3 py-1 rounded-lg text-xs font-bold border border-red-100 flex items-center gap-2">
                                                <i class="fa-solid fa-triangle-exclamation"></i> معدة محذوفة
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                {{-- الفترة --}}
                                <td class="p-6 text-center">
                                    <div
                                        class="inline-flex flex-col bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100 group-hover:bg-white transition-colors shadow-sm">
                                        <span
                                            class="text-slate-800 font-black text-sm">{{ $booking->start_date->diffInDays($booking->end_date) ?: 1 }}
                                            <span class="text-[10px] text-slate-400 font-bold">أيام</span></span>
                                        <span
                                            class="text-[10px] text-slate-400 font-mono tracking-tighter dir-ltr mt-0.5 font-bold">{{ $booking->start_date->format('Y/m/d') }}</span>
                                    </div>
                                </td>

                                {{-- الإجمالي --}}
                                <td class="p-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-lg font-black text-slate-900 tracking-tight">{{ number_format($booking->total_price) }}</span>
                                        <span class="text-[10px] font-extrabold text-orange-600">YER</span>
                                    </div>
                                </td>

                                {{-- الحالة --}}
                                <td class="p-6 text-center">
                                    @php
                                        $statusClasses = [
                                            'completed' => 'bg-green-50 text-green-600 border-green-100',
                                            'confirmed' => 'bg-blue-50 text-blue-600 border-blue-100',
                                            'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-100',
                                            'unpaid' => 'bg-slate-50 text-slate-500 border-slate-200',
                                            'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                        ];
                                        $currentClass =
                                            $statusClasses[$booking->status] ??
                                            'bg-slate-50 text-slate-500 border-slate-200';
                                    @endphp
                                    <span
                                        class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[11px] font-black border uppercase {{ $currentClass }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>

                                {{-- ❌ تم حذف عمود الإجراءات من هنا أيضاً --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mb-6 text-slate-200">
                                            <i class="fa-solid fa-calendar-xmark text-5xl tracking-tighter"></i>
                                        </div>
                                        <h3 class="text-xl font-bold text-slate-700 mb-1">لا توجد حجوزات</h3>
                                        <p class="text-slate-400 text-sm max-w-xs mx-auto">لم يتم العثور على أي عمليات حجز
                                            تطابق الفلتر المختار حالياً.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- الترقيم --}}
            @if ($bookings->hasPages())
                <div class="p-8 border-t border-slate-100 bg-slate-50/30">
                    {{ $bookings->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection
