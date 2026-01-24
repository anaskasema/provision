@extends('layouts.app')

@section('title', 'لوحة المزود - إدارة أعمالك')

@section('content')

    {{-- الهيدر --}}
    <div class="relative bg-slate-900 py-12 pb-40 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div
            class="absolute top-0 left-0 w-64 h-64 bg-orange-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col xl:flex-row justify-between items-start xl:items-end gap-8">
                <div class="max-w-xl">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="bg-orange-600 text-white text-[10px] font-bold px-2 py-1 rounded">PROVIDER</span>
                        <h1 class="text-3xl font-extrabold text-white">لوحة القيادة</h1>
                    </div>
                    <p class="text-slate-400 leading-relaxed text-sm">
                        مرحباً بك في مساحة عملك. هنا يمكنك إدارة طلبات التأجير، مراجعة هويات العملاء، وإصدار العقود الرسمية.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full xl:w-auto">
                    {{-- 1. الأرباح المعلقة --}}
                    <div
                        class="bg-white/5 backdrop-blur-sm border border-white/10 p-4 rounded-2xl flex items-center gap-4 min-w-[200px] hover:bg-white/10 transition group">
                        <div
                            class="w-12 h-12 rounded-xl bg-blue-500/10 text-blue-400 flex items-center justify-center text-xl border border-blue-500/20 group-hover:scale-110 transition">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block mb-1">أرباح قيد
                                التنفيذ</span>
                            <span class="text-xl font-extrabold text-white">
                                {{ number_format($incomingBookings->where('status', 'pending')->sum('total_price')) }}
                                <span class="text-[10px] text-blue-400 font-medium">YER</span>
                            </span>
                        </div>
                    </div>

                    {{-- 2. الأرباح المستلمة --}}
                    <div
                        class="bg-white/5 backdrop-blur-sm border border-white/10 p-4 rounded-2xl flex items-center gap-4 min-w-[200px] hover:bg-white/10 transition group">
                        <div
                            class="w-12 h-12 rounded-xl bg-green-500/10 text-green-400 flex items-center justify-center text-xl border border-green-500/20 group-hover:scale-110 transition">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                        <div>
                            <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block mb-1">أرباح
                                مكتملة</span>
                            <span class="text-xl font-extrabold text-white">
                                {{ number_format($incomingBookings->where('status', 'completed')->sum('total_price')) }}
                                <span class="text-[10px] text-green-400 font-medium">YER</span>
                            </span>
                        </div>
                    </div>

                    {{-- 3. الإجمالي الكلي --}}
                    <div
                        class="bg-gradient-to-br from-orange-600 to-orange-500 p-4 rounded-2xl flex items-center gap-4 min-w-[200px] shadow-lg shadow-orange-900/20 transform xl:-translate-y-2 group">
                        <div
                            class="w-12 h-12 rounded-xl bg-white/20 text-white flex items-center justify-center text-xl border border-white/30 group-hover:rotate-12 transition">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                        <div>
                            <span class="text-orange-100 text-[10px] font-bold uppercase tracking-wider block mb-1">الإجمالي
                                الكلي</span>
                            <span class="text-2xl font-extrabold text-white">
                                {{ number_format($incomingBookings->whereIn('status', ['confirmed', 'completed'])->sum('total_price')) }}
                                <span class="text-[10px] text-white/80 font-medium">YER</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- المحتوى الرئيسي --}}
    <div class="container mx-auto px-4 -mt-24 relative z-20 pb-20">

        {{-- شريط التعليمات --}}
        <div class="bg-blue-50 border-r-4 border-blue-500 p-4 rounded-lg shadow-sm mb-8 flex items-start gap-3">
            <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
            <div>
                <h4 class="font-bold text-blue-800 text-sm">دليل التعامل مع الطلبات:</h4>
                <p class="text-xs text-blue-600 mt-1 leading-relaxed">
                    1. راجع <strong>صورة الهوية</strong> وتواصل مع العميل للاتفاق على الدفع والضمانات.<br>
                    2. بعد الاتفاق، اضغط <strong>"قبول"</strong> ليتم إصدار عقد الإيجار.<br>
                    3. عند إعادة المعدة، اضغط <strong>"استلام"</strong> لإغلاق الطلب وإضافته لأرباحك.
                </p>
            </div>
        </div>

        {{-- جدول الطلبات الواردة --}}
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden mb-10">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-orange-500"></span> سجل الطلبات الواردة
                </h3>
                <span class="bg-slate-900 text-white text-xs px-3 py-1 rounded-lg font-bold shadow-sm">
                    {{ $incomingBookings->count() }} طلب
                </span>
            </div>

            @if ($incomingBookings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-right">
                        <thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                            <tr>
                                <th class="py-5 px-6 font-bold">العميل والمعدة</th>
                                <th class="py-5 px-6 font-bold">تفاصيل الحجز</th>
                                <th class="py-5 px-6 font-bold">الضمان (الهوية)</th>
                                <th class="py-5 px-6 font-bold">الحالة والتحكم</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($incomingBookings as $booking)
                                @php
                                    $daysDiff = now()->diffInDays($booking->end_date, false);
                                    $isOverdue = $daysDiff < 0;
                                    $isDueSoon = $daysDiff >= 0 && $daysDiff <= 1;
                                @endphp

                                <tr
                                    class="hover:bg-orange-50/10 transition duration-200 group {{ $isOverdue && $booking->status == 'confirmed' ? 'bg-red-50/30' : '' }}">

                                    {{-- 1. العميل والمعدة --}}
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-sm border border-slate-200">
                                                {{ substr($booking->user->first_name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-800 text-sm">
                                                    {{ $booking->user->first_name }} {{ $booking->user->last_name }}
                                                </div>
                                                <div class="text-xs text-orange-600 font-bold mt-0.5">
                                                    <i class="fa-solid fa-wrench"></i> {{ $booking->item->title }}
                                                </div>
                                                <div class="text-[10px] text-gray-400 mt-1 font-mono dir-ltr text-right">
                                                    <a href="tel:{{ $booking->user->phone }}"
                                                        class="hover:text-slate-800 transition">
                                                        {{ $booking->user->phone ?? 'لا يوجد هاتف' }} <i
                                                            class="fa-solid fa-phone-flip ml-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- 2. تفاصيل الحجز (مع شارات التنبيه) --}}
                                    <td class="py-4 px-6">
                                        {{-- 🔥 شارات التنبيه (Badges) تظهر هنا بوضوح 🔥 --}}
                                        @if ($booking->status == 'confirmed')
                                            @if ($isOverdue)
                                                <div
                                                    class="mb-2 inline-flex items-center gap-1 bg-red-100 text-red-700 px-2 py-1 rounded-md text-[10px] font-bold border border-red-200 animate-pulse">
                                                    <i class="fa-solid fa-circle-exclamation"></i>
                                                    متأخر {{ abs(round($daysDiff)) }} يوم!
                                                </div>
                                            @elseif ($isDueSoon)
                                                <div
                                                    class="mb-2 inline-flex items-center gap-1 bg-orange-100 text-orange-700 px-2 py-1 rounded-md text-[10px] font-bold border border-orange-200">
                                                    <i class="fa-regular fa-clock"></i>
                                                    موعد الإرجاع {{ $daysDiff == 0 ? 'اليوم' : 'غداً' }}
                                                </div>
                                            @endif
                                        @endif

                                        <div
                                            class="bg-gray-50 rounded-lg p-2 border border-gray-100 inline-block min-w-[140px]">
                                            <div class="flex justify-between items-center text-xs text-gray-500 mb-1">
                                                <span><i class="fa-regular fa-calendar text-orange-400"></i> المدة:</span>
                                                <span
                                                    class="font-bold text-slate-700">{{ $booking->start_date->diffInDays($booking->end_date) ?: 1 }}
                                                    يوم</span>
                                            </div>
                                            <div
                                                class="text-[10px] text-gray-400 border-t border-gray-200 pt-1 mt-1 text-center font-mono">
                                                {{ $booking->end_date->format('Y-m-d') }} <i
                                                    class="fa-solid fa-arrow-left mx-1"></i>
                                                {{ $booking->start_date->format('Y-m-d') }}
                                            </div>
                                        </div>

                                        @if ($booking->notes)
                                            <div
                                                class="mt-2 text-[10px] text-gray-500 bg-yellow-50 p-1.5 rounded border border-yellow-100 max-w-[180px]">
                                                <span class="font-bold text-yellow-700">ملاحظة:</span>
                                                {{ Str::limit($booking->notes, 50) }}
                                            </div>
                                        @endif
                                    </td>

                                    {{-- 3. الهوية --}}
                                    <td class="py-4 px-6">
                                        @if ($booking->identity_image)
                                            <a href="javascript:void(0)"
                                                onclick="showIdentity('{{ asset($booking->identity_image) }}')"
                                                class="flex items-center gap-2 bg-blue-50 text-blue-700 px-3 py-2 rounded-lg text-xs font-bold hover:bg-blue-100 transition border border-blue-200 w-fit">
                                                <i class="fa-solid fa-id-card text-lg"></i>
                                                <span>عرض الهوية</span>
                                            </a>
                                        @else
                                            <span
                                                class="flex items-center gap-2 bg-red-50 text-red-600 px-3 py-2 rounded-lg text-xs font-bold border border-red-200 w-fit">
                                                <i class="fa-solid fa-circle-exclamation"></i> لم ترفع
                                            </span>
                                        @endif
                                    </td>

                                    {{-- 4. الحالة والتحكم --}}
                                    <td class="py-4 px-6">
                                        @if ($booking->status == 'pending')
                                            <div class="flex gap-2">
                                                <form id="approve-form-{{ $booking->id }}"
                                                    action="{{ route('provider.bookings.approve', $booking->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="button" onclick="confirmApprove('{{ $booking->id }}')"
                                                        class="bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-green-700 transition shadow-md flex items-center gap-1">
                                                        <i class="fa-solid fa-check"></i> قبول
                                                    </button>
                                                </form>
                                                <form id="reject-form-{{ $booking->id }}"
                                                    action="{{ route('provider.bookings.reject', $booking->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="button" onclick="confirmReject('{{ $booking->id }}')"
                                                        class="bg-white border border-red-200 text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-50 transition shadow-sm flex items-center gap-1">
                                                        <i class="fa-solid fa-xmark"></i> رفض
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($booking->status == 'confirmed')
                                            <div class="flex flex-col gap-2">
                                                <a href="{{ route('bookings.contract', $booking->id) }}" target="_blank"
                                                    class="bg-slate-800 text-white px-3 py-2 rounded-lg text-xs font-bold hover:bg-slate-900 transition shadow-md text-center flex items-center justify-center gap-2">
                                                    <i class="fa-solid fa-file-contract text-orange-400"></i> طباعة العقد
                                                </a>
                                                <form id="complete-form-{{ $booking->id }}"
                                                    action="{{ route('provider.bookings.complete', $booking->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="button"
                                                        onclick="confirmComplete('{{ $booking->id }}')"
                                                        class="border px-3 py-2 rounded-lg text-xs font-bold transition w-full flex items-center justify-center gap-2 {{ $isDueSoon || $isOverdue ? 'bg-green-600 text-white hover:bg-green-700 border-green-600 animate-pulse' : 'bg-green-100 text-green-700 border-green-200 hover:bg-green-200' }}">
                                                        <i class="fa-solid fa-flag-checkered"></i> إنهاء واستلام
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-bold border {{ $booking->status == 'completed' ? 'bg-blue-50 text-blue-700 border-blue-100' : 'bg-gray-100 text-gray-500 border-gray-200' }}">
                                                    {{ $booking->status == 'completed' ? 'مكتمل' : 'مرفوض/ملغي' }}
                                                </span>
                                                @if ($booking->status == 'completed')
                                                    <a href="{{ route('bookings.contract', $booking->id) }}"
                                                        target="_blank"
                                                        class="block mt-2 text-[10px] text-gray-400 underline hover:text-orange-600">أرشيف
                                                        العقد</a>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-16 bg-slate-50/50">
                    <div
                        class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 text-3xl text-gray-300 shadow-sm border border-gray-100">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                    <h3 class="text-slate-800 font-bold mb-1">صندوق الطلبات فارغ</h3>
                    <p class="text-slate-500 text-sm">لا توجد طلبات جديدة حالياً.</p>
                </div>
            @endif
        </div>

        {{-- القسم الثاني: إدارة المعدات (كما هو) --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <span class="w-2 h-8 bg-slate-900 rounded-full"></span> معداتي المعروضة
            </h2>
            <a href="{{ route('items.create') }}"
                class="bg-orange-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-orange-700 transition shadow-lg shadow-orange-500/20 flex items-center gap-2 transform hover:-translate-y-0.5">
                <i class="fa-solid fa-plus"></i> إضافة معدة جديدة
            </a>
        </div>

        @if ($myItems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($myItems as $item)
                    @php
                        // التحقق من الحجز النشط
                        $isBookedNow = $item
                            ->bookings()
                            ->whereIn('status', ['confirmed', 'pending'])
                            ->whereDate('start_date', '<=', now())
                            ->whereDate('end_date', '>=', now())
                            ->exists();

                        $statusLabel = 'متاح للتأجير';
                        $statusClass = 'bg-green-100 text-green-700 border-green-200';

                        if (!$item->is_available) {
                            $statusLabel = 'غير متاح (مخفي)';
                            $statusClass = 'bg-gray-100 text-gray-600 border-gray-200';
                        } elseif ($isBookedNow) {
                            $statusLabel = 'مشغول حالياً';
                            $statusClass = 'bg-red-100 text-red-700 border-red-200';
                        }

                        $images = is_string($item->images) ? json_decode($item->images, true) : $item->images;
                        $img = !empty($images) ? $images[0] : 'https://via.placeholder.com/300';
                    @endphp

                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group hover:shadow-xl transition duration-300">
                        <div class="relative h-48 bg-gray-200 overflow-hidden">
                            <img src="{{ asset($img) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div
                                class="absolute bottom-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-xl text-sm font-bold text-slate-900 shadow-sm border border-gray-100">
                                {{ number_format($item->price_per_day) }} <span
                                    class="text-[10px] text-gray-500">YER/يوم</span>
                            </div>
                            <div class="absolute top-3 left-3">
                                <span
                                    class="px-2 py-1 rounded-lg text-[10px] font-bold shadow-sm border {{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>
                        </div>

                        <div class="p-5">
                            <h3 class="font-bold text-slate-900 mb-1 text-lg truncate">{{ $item->title }}</h3>
                            <p class="text-xs text-gray-500 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-orange-500"></i>
                                {{ $item->category->name ?? 'عام' }}
                                <span class="text-gray-300">|</span>
                                <i class="fa-solid fa-location-dot text-gray-400"></i> {{ $item->city }}
                            </p>

                            <div class="flex gap-2 pt-4 border-t border-gray-50">
                                <a href="{{ route('items.show', $item) }}" target="_blank"
                                    class="flex-1 bg-gray-50 text-gray-600 hover:bg-slate-900 hover:text-white py-2 rounded-lg text-center text-xs font-bold transition flex items-center justify-center gap-1">
                                    <i class="fa-regular fa-eye"></i> عرض
                                </a>
                                <a href="{{ route('items.edit', $item->id) }}"
                                    class="flex-1 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white py-2 rounded-lg text-center text-xs font-bold transition flex items-center justify-center gap-1">
                                    <i class="fa-solid fa-pen-to-square"></i> تعديل
                                </a>
                                <form id="delete-item-form-{{ $item->id }}"
                                    action="{{ route('items.destroy', $item->id) }}" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="confirmDeleteItem('{{ $item->id }}')"
                                        class="w-full bg-red-50 text-red-600 hover:bg-red-500 hover:text-white py-2 rounded-lg text-center text-xs font-bold transition flex items-center justify-center gap-1">
                                        <i class="fa-regular fa-trash-can"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
                <div
                    class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl text-orange-300">
                    <i class="fa-solid fa-box-open"></i></div>
                <h3 class="text-lg font-bold text-slate-800 mb-2">ابدأ بإضافة معداتك</h3>
                <p class="text-gray-500 mb-6 text-sm">ليس لديك أي معدات معروضة حالياً.</p>
                <a href="{{ route('items.create') }}"
                    class="inline-flex items-center gap-2 bg-slate-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800 transition shadow-lg"><i
                        class="fa-solid fa-plus"></i> إضافة أول معدة</a>
            </div>
        @endif

    </div>

    {{-- سكربتات التفاعل (نفسها السابقة) --}}
    <script>
        function confirmApprove(id) {
            Swal.fire({
                title: 'هل راجعت الهوية؟',
                text: "بموافقتك، سيعتبر أنك تحققت من هوية العميل.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'نعم، وافق',
                cancelButtonText: 'تراجع'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('approve-form-' + id).submit();
            })
        }

        function confirmReject(id) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "سيتم رفض الطلب.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'نعم، ارفض',
                cancelButtonText: 'تراجع'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('reject-form-' + id).submit();
            })
        }

        function confirmComplete(id) {
            Swal.fire({
                title: 'هل استلمت المعدة؟',
                text: "يجب التأكد من سلامة المعدة.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#1e293b',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'نعم، تم الاستلام',
                cancelButtonText: 'لا'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('complete-form-' + id).submit();
            })
        }

        function showIdentity(imageUrl) {
            Swal.fire({
                title: 'الهوية',
                imageUrl: imageUrl,
                imageWidth: 600,
                showCloseButton: true,
                showConfirmButton: false,
                background: '#f8fafc',
                backdrop: `rgba(0,0,0,0.8)`
            })
        }

        function confirmDeleteItem(id) {
            Swal.fire({
                title: 'حذف نهائي؟',
                text: "لا يمكن التراجع.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'إلغاء'
            }).then((result) => {
                if (result.isConfirmed) document.getElementById('delete-item-form-' + id).submit();
            })
        }
    </script>

@endsection
