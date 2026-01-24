@extends('layouts.admin')

@section('title', 'ملف المستخدم: ' . $user->first_name)

@section('content')

    {{-- 1. الهيدر الكحلي (Hero Section) --}}
    <div class="relative bg-slate-900 py-12 pb-32 rounded-3xl overflow-hidden shadow-lg mx-4 mt-4">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>

        <div class="relative z-10 px-8 flex flex-col md:flex-row items-center md:items-end gap-6 text-center md:text-right">
            {{-- الصورة الشخصية --}}
            <div class="relative">
                <div class="w-24 h-24 rounded-3xl bg-white p-1 shadow-2xl rotate-3 hover:rotate-0 transition duration-300">
                    @if ($user->avatar)
                        <img src="{{ $user->avatar }}" class="w-full h-full rounded-2xl object-cover">
                    @else
                        <div
                            class="w-full h-full rounded-2xl bg-slate-100 flex items-center justify-center text-3xl font-extrabold text-slate-400">
                            {{ substr($user->first_name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="absolute -bottom-2 -right-2 bg-white rounded-full p-1 shadow-sm">
                    @if ($user->role == 'admin')
                        <span class="w-6 h-6 flex items-center justify-center bg-red-500 text-white rounded-full text-xs"
                            title="مدير"><i class="fa-solid fa-shield-cat"></i></span>
                    @elseif($user->role == 'provider')
                        <span class="w-6 h-6 flex items-center justify-center bg-purple-500 text-white rounded-full text-xs"
                            title="مزود"><i class="fa-solid fa-briefcase"></i></span>
                    @else
                        <span class="w-6 h-6 flex items-center justify-center bg-blue-500 text-white rounded-full text-xs"
                            title="مستأجر"><i class="fa-solid fa-user"></i></span>
                    @endif
                </div>
            </div>

            <div class="flex-1">
                <h1 class="text-3xl font-extrabold text-white mb-1">{{ $user->first_name }} {{ $user->last_name }}</h1>
                <p class="text-slate-400 font-mono text-sm mb-3">{{ $user->email }}</p>

                <div class="flex items-center justify-center md:justify-start gap-2">
                    <span
                        class="px-3 py-1 rounded-full text-xs font-bold border 
                        {{ $user->role == 'admin' ? 'bg-red-500/10 text-red-400 border-red-500/20' : ($user->role == 'provider' ? 'bg-purple-500/10 text-purple-400 border-purple-500/20' : 'bg-blue-500/10 text-blue-400 border-blue-500/20') }}">
                        {{ $user->role == 'admin' ? 'مدير النظام' : ($user->role == 'provider' ? 'مزود خدمة' : 'مستأجر') }}
                    </span>
                    @if ($user->email_verified_at)
                        <span
                            class="px-3 py-1 rounded-full text-xs font-bold bg-green-500/10 text-green-400 border border-green-500/20 flex items-center gap-1">
                            <i class="fa-solid fa-check-circle"></i> موثق
                        </span>
                    @else
                        <span
                            class="px-3 py-1 rounded-full text-xs font-bold bg-orange-500/10 text-orange-400 border border-orange-500/20">غير
                            مؤكد</span>
                    @endif
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.users.edit', $user->id) }}"
                    class="bg-white/10 hover:bg-white/20 text-white px-5 py-2.5 rounded-2xl font-bold text-sm transition backdrop-blur-md flex items-center gap-2">
                    <i class="fa-solid fa-pen"></i> تعديل
                </a>
                <a href="{{ route('admin.users') }}"
                    class="bg-white/5 hover:bg-white/10 text-slate-300 px-5 py-2.5 rounded-2xl font-bold text-sm transition backdrop-blur-md border border-white/5">
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    {{-- 2. المحتوى المتداخل (-mt-24) --}}
    <div class="px-4 -mt-24 relative z-20 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- العمود الأيمن: البطاقات والإجراءات --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- بطاقة المعلومات --}}
                <div class="bg-white rounded-[2.5rem] shadow-xl border border-gray-100 p-8">
                    <h3 class="font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fa-regular fa-address-card text-orange-500"></i> بيانات الاتصال
                    </h3>
                    <div class="space-y-5">
                        <div class="flex justify-between items-center border-b border-gray-50 pb-3">
                            <span class="text-slate-500 text-sm flex items-center gap-2"><i
                                    class="fa-solid fa-phone text-slate-300"></i> الهاتف</span>
                            <span class="font-bold text-slate-800 dir-ltr">{{ $user->phone ?? '---' }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-gray-50 pb-3">
                            <span class="text-slate-500 text-sm flex items-center gap-2"><i
                                    class="fa-solid fa-location-dot text-slate-300"></i> المدينة</span>
                            <span class="font-bold text-slate-800">{{ $user->city ?? 'غير محدد' }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 text-sm flex items-center gap-2"><i
                                    class="fa-regular fa-calendar text-slate-300"></i> تاريخ الانضمام</span>
                            <span class="font-bold text-slate-800 text-xs">{{ $user->created_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                </div>

                {{-- التحكم بالحساب (لغير الشخص نفسه) --}}
                @if ($user->id !== auth()->id())
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                        <h3 class="font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <i class="fa-solid fa-gear text-slate-400"></i> الإجراءات الإدارية
                        </h3>

                        {{-- فورم الحظر --}}
                        <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" class="mb-4"
                            id="ban-form-{{ $user->id }}">
                            @csrf
                            <button type="button"
                                onclick="confirmAction(event, 'ban-form-{{ $user->id }}', '{{ $user->is_banned ? 'فك الحظر' : 'حظر الحساب' }}', '{{ $user->is_banned ? 'هل تريد إعادة تفعيل هذا الحساب؟' : 'هل أنت متأكد من حظر هذا المستخدم؟ لن يتمكن من الدخول للنظام.' }}', '{{ $user->is_banned ? 'success' : 'warning' }}')"
                                class="w-full py-3 rounded-2xl font-bold text-sm transition flex items-center justify-center gap-2 {{ $user->is_banned ? 'bg-green-50 text-green-600 hover:bg-green-100' : 'bg-red-50 text-red-600 hover:bg-red-100' }}">
                                <i class="fa-solid {{ $user->is_banned ? 'fa-lock-open' : 'fa-ban' }}"></i>
                                {{ $user->is_banned ? 'فك الحظر وتفعيل الحساب' : 'حظر الحساب مؤقتاً' }}
                            </button>
                        </form>

                        {{-- فورم تغيير الصلاحية --}}
                        <form action="{{ route('admin.users.role', $user->id) }}" method="POST"
                            id="role-form-{{ $user->id }}">
                            @csrf
                            <label class="text-xs font-bold text-slate-400 block mb-2">تغيير الصلاحية:</label>
                            <div class="flex gap-2">
                                <div class="relative flex-1">
                                    <select name="role"
                                        onchange="confirmAction(event, 'role-form-{{ $user->id }}', 'تغيير الصلاحية', 'هل أنت متأكد من تغيير دور هذا المستخدم؟ قد تتغير الصلاحيات المتاحة له.')"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl text-sm px-3 py-2.5 focus:outline-none focus:border-orange-500 font-bold appearance-none cursor-pointer">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>مستأجر
                                        </option>
                                        <option value="provider" {{ $user->role == 'provider' ? 'selected' : '' }}>مزود
                                            خدمة</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>مدير</option>
                                    </select>
                                    <i
                                        class="fa-solid fa-chevron-down absolute left-3 top-3.5 text-xs text-slate-400 pointer-events-none"></i>
                                </div>
                                {{-- زر حفظ وهمي فقط للمنظر، لأن الـ select يعمل تلقائياً --}}
                                <button type="button"
                                    class="bg-slate-900 text-white px-4 rounded-xl text-sm font-bold hover:bg-slate-800 transition cursor-default">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            {{-- العمود الأيسر: الإحصائيات والجداول --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- 1. إحصائيات النشاط --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div
                        class="bg-gradient-to-br from-blue-500 to-indigo-600 p-6 rounded-[2rem] text-white shadow-lg relative overflow-hidden group">
                        <div class="relative z-10">
                            <p class="text-blue-100 text-xs font-bold uppercase tracking-wider mb-1">إجمالي المصروفات</p>
                            <h3 class="text-3xl font-extrabold">{{ number_format($wallet['total_spent']) }} <span
                                    class="text-sm font-medium">YER</span></h3>
                        </div>
                        <i
                            class="fa-solid fa-wallet absolute -bottom-4 -left-4 text-6xl text-white/10 group-hover:scale-110 transition-transform"></i>
                    </div>

                    @if ($items->count() > 0 || $wallet['total_earnings'] > 0)
                        <div
                            class="bg-gradient-to-br from-emerald-500 to-teal-600 p-6 rounded-[2rem] text-white shadow-lg relative overflow-hidden group">
                            <div class="relative z-10">
                                <p class="text-emerald-100 text-xs font-bold uppercase tracking-wider mb-1">إجمالي الأرباح
                                </p>
                                <h3 class="text-3xl font-extrabold">{{ number_format($wallet['total_earnings']) }} <span
                                        class="text-sm font-medium">YER</span></h3>
                            </div>
                            <i
                                class="fa-solid fa-sack-dollar absolute -bottom-4 -left-4 text-6xl text-white/10 group-hover:scale-110 transition-transform"></i>
                        </div>
                    @else
                        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm relative overflow-hidden">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">مرات الاستئجار</p>
                            <h3 class="text-3xl font-extrabold text-slate-800">{{ $bookings->count() }}</h3>
                            <i class="fa-solid fa-bag-shopping absolute -bottom-4 -left-4 text-6xl text-slate-50"></i>
                        </div>
                    @endif

                    @if ($items->count() > 0)
                        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm relative overflow-hidden">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">المعدات المعروضة</p>
                            <h3 class="text-3xl font-extrabold text-orange-500">{{ $items->count() }}</h3>
                            <i class="fa-solid fa-box-open absolute -bottom-4 -left-4 text-6xl text-slate-50"></i>
                        </div>
                    @else
                        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm relative overflow-hidden">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">الحجوزات النشطة</p>
                            <h3 class="text-3xl font-extrabold text-green-500">{{ $activeBookingsCount }}</h3>
                            <i class="fa-solid fa-clock absolute -bottom-4 -left-4 text-6xl text-slate-50"></i>
                        </div>
                    @endif
                </div>

                {{-- 2. جدول المعدات المملوكة --}}
                @if ($items->count() > 0)
                    <div class="bg-white rounded-[2.5rem] shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-slate-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                <i class="fa-solid fa-layer-group text-orange-500"></i> المعدات المملوكة
                                ({{ $items->count() }})
                            </h3>
                            <a href="{{ route('items.index', ['user_id' => $user->id]) }}" target="_blank"
                                class="text-xs font-bold text-blue-600 hover:underline">عرض في الموقع</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right text-sm">
                                <thead
                                    class="bg-slate-50 text-slate-500 font-bold border-b border-gray-100 text-xs uppercase">
                                    <tr>
                                        <th class="p-5">المعدة</th>
                                        <th class="p-5">السعر</th>
                                        <th class="p-5">الحالة</th>
                                        <th class="p-5 text-center">التقييم</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($items as $item)
                                        <tr class="hover:bg-orange-50/10 transition">
                                            <td class="p-5">
                                                <div class="flex items-center gap-3">
                                                    @php
                                                        $img = $item->images;
                                                        if (is_string($img)) {
                                                            $img = json_decode($img, true);
                                                        }
                                                        $thumb = is_array($img) ? $img[0] ?? '' : '';
                                                    @endphp
                                                    <img src="{{ $thumb ?: 'https://via.placeholder.com/50' }}"
                                                        class="w-10 h-10 rounded-xl object-cover border border-gray-100 shadow-sm">
                                                    <a href="{{ route('items.show', $item->id) }}" target="_blank"
                                                        class="font-bold text-slate-800 hover:text-orange-600 transition">{{ $item->title }}</a>
                                                </div>
                                            </td>
                                            <td class="p-5 font-bold text-slate-600">
                                                {{ number_format($item->price_per_day) }}</td>
                                            <td class="p-5">
                                                <span
                                                    class="px-2.5 py-1 rounded-full text-xs font-bold {{ $item->is_available ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                                    {{ $item->is_available ? 'متاح' : 'مخفي' }}
                                                </span>
                                            </td>
                                            <td class="p-5 text-center text-orange-400 text-xs">
                                                <i class="fa-solid fa-star"></i> {{ $item->rating() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                {{-- 3. جدول سجل الاستئجار --}}
                @if ($bookings->count() > 0)
                    <div class="bg-white rounded-[2.5rem] shadow-lg border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-slate-50/50 flex justify-between items-center">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                <i class="fa-solid fa-history text-blue-500"></i> سجل الاستئجار ({{ $bookings->count() }})
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right text-sm">
                                <thead
                                    class="bg-slate-50 text-slate-500 font-bold border-b border-gray-100 text-xs uppercase">
                                    <tr>
                                        <th class="p-5">رقم الحجز</th>
                                        <th class="p-5">المعدة</th>
                                        <th class="p-5">التاريخ</th>
                                        <th class="p-5">المبلغ</th>
                                        <th class="p-5 text-center">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($bookings as $booking)
                                        <tr class="hover:bg-blue-50/10 transition">
                                            <td class="p-5 font-mono text-slate-400 text-xs">#{{ $booking->id }}</td>
                                            <td class="p-5 font-bold text-slate-800">
                                                {{ $booking->item->title ?? 'معدة محذوفة' }}</td>
                                            <td class="p-5 text-slate-500 text-xs">
                                                {{ $booking->created_at->format('Y-m-d') }}</td>
                                            <td class="p-5 font-bold">{{ number_format($booking->total_price) }}</td>
                                            <td class="p-5 text-center">
                                                @php
                                                    $statusClass = match ($booking->status) {
                                                        'completed' => 'text-green-600 bg-green-50',
                                                        'confirmed' => 'text-blue-600 bg-blue-50',
                                                        'cancelled' => 'text-red-600 bg-red-50',
                                                        default => 'text-orange-600 bg-orange-50',
                                                    };
                                                    $statusText = match ($booking->status) {
                                                        'completed' => 'مكتمل',
                                                        'confirmed' => 'مؤكد',
                                                        'cancelled' => 'ملغي',
                                                        default => 'معلق',
                                                    };
                                                @endphp
                                                <span
                                                    class="{{ $statusClass }} px-2.5 py-1 rounded-full text-xs font-bold">{{ $statusText }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    @if ($items->count() == 0)
                        <div class="text-center py-16 bg-white rounded-[2.5rem] border border-gray-100 border-dashed">
                            <div
                                class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-200">
                                <i class="fa-regular fa-folder-open text-4xl"></i>
                            </div>
                            <p class="text-slate-400 font-bold">هذا المستخدم ليس لديه أي نشاط بعد.</p>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>

    {{-- إضافة سكريبت التأكيد (لضمان عمله في هذه الصفحة أيضاً) --}}
    <script>
        function confirmAction(e, formId, title, text, icon = 'warning') {
            e.preventDefault();

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#0f172a',
                cancelButtonColor: '#f97316',
                confirmButtonText: 'نعم، نفذ',
                cancelButtonText: 'تراجع',
                customClass: {
                    popup: 'rounded-3xl font-sans',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                } else {
                    if (e.target.tagName === 'SELECT') {
                        location.reload();
                    }
                }
            });
        }
    </script>

@endsection
