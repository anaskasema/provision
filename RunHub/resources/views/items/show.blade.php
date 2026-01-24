@extends('layouts.app')

@section('title', $item->title)

@section('content')

    {{-- معالجة البيانات --}}
    @php
        $rawImages = $item->images;
        $images = is_string($rawImages) ? json_decode($rawImages, true) : $rawImages;
        $images = is_array($images) ? $images : [];
        $mainImage = !empty($images) ? $images[0] : 'https://via.placeholder.com/800x600';

        $rawSpecs = $item->specifications;
        $specs = is_string($rawSpecs) ? json_decode($rawSpecs, true) : $rawSpecs;
        $specs = is_array($specs) ? $specs : [];

        // التحقق من الحجز الحالي (للعرض فقط، وليس للمنع)
        $currentBooking = null;
        if (method_exists($item, 'bookings')) {
            $currentBooking = $item
                ->bookings()
                ->whereIn('status', ['confirmed', 'pending'])
                ->where('end_date', '>=', now()->toDateString())
                ->orderBy('start_date', 'asc')
                ->first();
        }
        $isReserved = (bool) $currentBooking;
    @endphp

    {{-- الهيدر --}}
    <div class="relative bg-slate-900 py-20 pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="container mx-auto px-4 relative z-10">
            <nav class="flex text-sm font-medium text-slate-400 mb-6 gap-2 items-center">
                <a href="{{ route('items.index') }}" class="hover:text-white transition">المعدات</a>
                <i class="fa-solid fa-chevron-left text-[10px]"></i>
                <a href="{{ route('items.index', ['category' => $item->category->id]) }}"
                    class="hover:text-white transition">{{ $item->category->name }}</a>
                <i class="fa-solid fa-chevron-left text-[10px]"></i>
                <span class="text-orange-500 font-bold">{{ $item->title }}</span>
            </nav>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                <div>
                    <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4 leading-tight">{{ $item->title }}</h1>
                    <div class="flex flex-wrap items-center gap-3 text-sm">
                        <span
                            class="bg-white/10 px-4 py-2 rounded-full border border-white/10 text-gray-200 backdrop-blur-sm font-bold flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-orange-500"></i> {{ $item->city }}
                        </span>
                        <span
                            class="bg-white/10 px-4 py-2 rounded-full border border-white/10 text-gray-200 backdrop-blur-sm font-bold flex items-center gap-2">
                            <i class="fa-solid fa-layer-group text-orange-500"></i> {{ $item->category->name }}
                        </span>
                    </div>
                </div>

                <div
                    class="flex items-center gap-4 bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/10">
                    <div class="text-right">
                        <div class="text-orange-400 text-sm flex gap-1 mb-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $item->rating() ? '' : 'text-slate-600' }}"></i>
                            @endfor
                        </div>
                        <p class="text-slate-300 text-xs font-bold">{{ $item->reviews->count() }} تقييم</p>
                    </div>
                    <div class="text-4xl font-extrabold text-white">{{ $item->rating() }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-20 relative z-20 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- اليمين: الصور والتفاصيل --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- المعرض --}}
                <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden border-4 border-white">
                    <div class="relative h-[400px] md:h-[500px] bg-gray-200 group">
                        <img id="mainDisplayImage" src="{{ $mainImage }}"
                            class="w-full h-full object-cover transition-opacity duration-300">
                    </div>
                    @if (count($images) > 1)
                        <div class="flex gap-3 overflow-x-auto p-4 bg-white border-t border-gray-100">
                            @foreach ($images as $img)
                                <img src="{{ $img }}" onclick="changeImage(this.src)"
                                    class="w-20 h-20 rounded-xl object-cover cursor-pointer border-2 border-transparent hover:border-orange-500 transition ring-2 ring-transparent hover:ring-orange-100">
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- الوصف والمواصفات --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-align-right text-orange-500"></i> الوصف
                    </h3>
                    <p class="text-gray-600 leading-loose text-lg whitespace-pre-line">{{ $item->description }}</p>

                    <h3 class="text-2xl font-bold text-slate-900 mt-10 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-orange-500"></i> المواصفات الفنية
                    </h3>
                    @if (count($specs) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($specs as $key => $value)
                                <div
                                    class="flex justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-orange-200 transition">
                                    <span class="text-gray-500 font-bold">{{ $key }}</span>
                                    <span class="font-bold text-slate-900">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400">لا توجد مواصفات إضافية.</p>
                    @endif
                </div>

                {{-- 🔥 شروط الاستئجار والاسترداد (جديد) 🔥 --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-file-contract text-orange-500"></i> شروط الاستئجار والاسترداد
                    </h3>
                    <div class="space-y-4 text-sm text-gray-600 leading-relaxed">
                        <div class="flex gap-3">
                            <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                            <p><strong>الهوية والضمان:</strong> يجب تسليم الهوية الأصلية أو ما يعادلها كضمان للمؤجر عند
                                استلام المعدة، ويتم استردادها بعد فحص المعدة وإرجاعها سليمة.</p>
                        </div>
                        <div class="flex gap-3">
                            <i class="fa-solid fa-circle-check text-green-500 mt-1"></i>
                            <p><strong>الدفع والاتفاق:</strong> يتم دفع المبلغ المتفق عليه (عربون أو كامل) مباشرة للمؤجر عند
                                التسليم أو عبر التحويل البنكي حسب الاتفاق.</p>
                        </div>
                        <div class="flex gap-3">
                            <i class="fa-solid fa-circle-xmark text-red-500 mt-1"></i>
                            <p><strong>سياسة الإلغاء:</strong> في حال إلغاء الحجز قبل 24 ساعة من الموعد، لا يترتب عليك أي
                                رسوم. الإلغاء المتأخر قد يعرضك لتقييم سلبي أو وضعك في القائمة السوداء.</p>
                        </div>
                        <div class="flex gap-3">
                            <i class="fa-solid fa-triangle-exclamation text-orange-500 mt-1"></i>
                            <p><strong>المسؤولية:</strong> المستأجر مسؤول مسؤولية كاملة عن المعدة من لحظة الاستلام وحتى
                                التسليم.</p>
                        </div>
                    </div>
                </div>

                {{-- التقييمات (تم التحديث لإضافة النموذج) --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">

                    {{-- عنوان القسم --}}
                    <h3 class="text-2xl font-bold text-slate-900 mb-6">آراء العملاء ({{ $item->reviews->count() }})</h3>

                    {{-- قائمة التقييمات السابقة --}}
                    <div class="space-y-6 max-h-[400px] overflow-y-auto custom-scrollbar pr-2">
                        @forelse($item->reviews as $review)
                            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-3">
                                        {{-- صورة المستخدم --}}
                                        <div
                                            class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center font-bold text-slate-600 overflow-hidden border border-slate-300">
                                            @if ($review->user->avatar)
                                                <img src="{{ $review->user->avatar }}" class="w-full h-full object-cover">
                                            @else
                                                {{ substr($review->user->first_name, 0, 1) }}
                                            @endif
                                        </div>

                                        {{-- اسم المستخدم والتاريخ --}}
                                        <div>
                                            <h5 class="font-bold text-slate-900">{{ $review->user->first_name }}</h5>
                                            <span
                                                class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>

                                    {{-- النجوم المعطاة --}}
                                    <div class="flex text-orange-400 text-sm">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                </div>

                                {{-- نص التعليق --}}
                                <p class="text-gray-700">{{ $review->comment }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">لا توجد تقييمات بعد.</p>
                        @endforelse
                    </div>

                    {{-- نموذج إضافة تقييم جديد (يظهر فقط للمسجلين وغير مالك المعدة) --}}
                    @auth
                        @if (Auth::id() !== $item->user_id)
                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <h4 class="font-bold text-slate-900 mb-4">أضف تقييمك</h4>

                                <form action="{{ route('reviews.store', $item) }}" method="POST">
                                    @csrf

                                    {{-- نجوم التقييم (Radio Buttons) --}}
                                    <div
                                        class="flex flex-row-reverse justify-end gap-2 text-2xl text-gray-300 mb-4 cursor-pointer w-fit">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating"
                                                value="{{ $i }}" class="peer sr-only" required>
                                            <label for="star{{ $i }}"
                                                class="peer-checked:text-orange-400 hover:text-orange-400 transition">★</label>
                                        @endfor
                                    </div>

                                    {{-- حقل كتابة التعليق --}}
                                    <textarea name="comment" rows="3"
                                        class="w-full bg-white border border-gray-200 rounded-xl p-3 focus:outline-none focus:border-orange-500"
                                        placeholder="اكتب تعليقك..."></textarea>

                                    {{-- زر الإرسال --}}
                                    <button type="submit"
                                        class="mt-3 bg-slate-900 text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-slate-800 transition">
                                        نشر التقييم
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                </div>
            </div>

            {{-- اليسار: نموذج الحجز --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <div class="bg-white rounded-[2rem] shadow-xl border border-orange-100 p-8 overflow-hidden relative">

                        {{-- تنبيه الحجز الحالي --}}
                        @if ($isReserved)
                            <div
                                class="absolute top-0 left-0 w-full bg-red-600 text-white py-2 px-4 text-center text-[10px] font-black uppercase tracking-wider z-10 shadow-lg animate-pulse">
                                <i class="fa-solid fa-calendar-day ml-1"></i> المعدة مشغولة حالياً
                            </div>

                            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl mt-4">
                                <p class="text-red-700 text-xs font-bold mb-1 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-info"></i> تنبيه التوفر:
                                </p>
                                <p class="text-red-600 text-[11px] leading-relaxed">
                                    هذه المعدة محجوزة من <span
                                        class="font-black">{{ $currentBooking->start_date->format('Y-m-d') }}</span>
                                    إلى <span class="font-black">{{ $currentBooking->end_date->format('Y-m-d') }}</span>.
                                    <br>
                                    <span class="text-slate-800 font-bold">يمكنك حجزها لتواريخ بعد هذا الموعد.</span>
                                </p>
                            </div>
                        @endif

                        <div class="text-center mb-8 {{ $isReserved ? '' : 'mt-2' }}">
                            <p class="text-sm text-gray-500 font-bold uppercase mb-2">سعر الإيجار اليومي</p>
                            <div class="flex items-center justify-center gap-1">
                                <span class="text-5xl font-extrabold text-slate-900"
                                    id="priceDisplay">{{ number_format($item->price_per_day) }}</span>
                                <span class="text-lg font-bold text-orange-600 self-end mb-1">{{ $item->currency }}</span>
                            </div>
                        </div>

                        @if (session('success'))
                            <div
                                class="mb-4 p-3 bg-green-50 text-green-700 rounded-xl text-sm font-bold flex items-center gap-2">
                                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div
                                class="mb-4 p-3 bg-red-50 text-red-700 rounded-xl text-sm font-bold flex items-center gap-2">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
                            </div>
                        @endif

                        @if (Auth::id() !== $item->user_id)
                            <form action="{{ route('bookings.store', $item) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="space-y-4 mb-6">
                                    {{-- حقول التاريخ --}}
                                    <div>
                                        <label class="text-xs font-bold text-gray-700 uppercase block mb-1">تاريخ
                                            الاستلام</label>
                                        <input type="date" name="start_date" id="startDate" required
                                            {{-- ✅ هنا التعديل: لا نغلق الحقل، بل نحدد الحد الأدنى لليوم --}} min="{{ date('Y-m-d') }}"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold focus:border-orange-500 focus:outline-none cursor-pointer">
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-gray-700 uppercase block mb-1">تاريخ
                                            الإرجاع</label>
                                        <input type="date" name="end_date" id="endDate" required
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 font-bold focus:border-orange-500 focus:outline-none cursor-pointer">
                                    </div>

                                    {{-- 🔥 حقل رفع الهوية (محدث) 🔥 --}}
                                    <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl">
                                        <label
                                            class="text-xs font-bold text-blue-800 uppercase block mb-2 flex items-center gap-2">
                                            <i class="fa-solid fa-id-card"></i> إثبات الهوية (إجباري)
                                        </label>
                                        <input type="file" name="identity_image" required accept="image/*"
                                            class="w-full bg-white border border-blue-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 transition">

                                        <p
                                            class="text-[11px] text-blue-700 mt-2 font-bold leading-relaxed flex items-start gap-1">
                                            <i class="fa-solid fa-camera mt-0.5"></i>
                                            هام: يرجى تصوير البطاقة الشخصية (الأصل) من الجهتين في صورة واحدة واضحة لضمان
                                            قبول الطلب.
                                        </p>
                                    </div>

                                    <div>
                                        <label class="text-xs font-bold text-gray-700 uppercase block mb-1">ملاحظات للمالك
                                            (اختياري)</label>
                                        <textarea name="notes" rows="2" placeholder="وقت الاستلام المفضل، استفسار عن الضمان..."
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:border-orange-500 focus:outline-none text-sm"></textarea>
                                    </div>
                                </div>

                                {{-- ملخص السعر --}}
                                <div id="priceSummary"
                                    class="hidden mb-6 bg-orange-50 p-4 rounded-xl border border-orange-100">
                                    <div class="flex justify-between text-sm font-bold mb-2">
                                        <span class="text-gray-600">المدة:</span>
                                        <span class="text-slate-900"><span id="daysCount">0</span> أيام</span>
                                    </div>
                                    <div
                                        class="flex justify-between text-lg font-extrabold border-t border-orange-200 pt-2">
                                        <span class="text-slate-800">الإجمالي:</span>
                                        <span class="text-orange-600"><span id="totalPrice">0</span>
                                            {{ $item->currency }}</span>
                                    </div>
                                </div>

                                {{-- 🔥 مربع الشروط والإقرار (محدث) 🔥 --}}
                                <div class="mb-6 flex items-start gap-3 bg-gray-50 p-3 rounded-lg border border-gray-200">
                                    <input type="checkbox" required id="termsAgree"
                                        class="mt-1 w-4 h-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500 cursor-pointer">
                                    <label for="termsAgree"
                                        class="text-xs text-gray-600 leading-relaxed cursor-pointer select-none font-bold">
                                        أوافق على الشروط أعلاه، وأتعهد بتوفير الضمان المطلوب للمؤجر عند الاستلام.
                                    </label>
                                </div>

                                {{-- توضيح ما بعد الحجز --}}
                                <p class="text-[10px] text-center text-gray-400 mb-3">
                                    بمجرد الإرسال، سيراجع المزود طلبك ويتواصل معك لتأكيد الحجز.
                                </p>

                                {{-- زر الإرسال (مفتوح دائماً للمسجلين) --}}
                                @auth
                                    <button type="submit"
                                        class="w-full bg-slate-900 text-white font-bold py-4 rounded-xl hover:bg-slate-800 transition shadow-lg flex justify-center items-center gap-2">
                                        <span>إرسال طلب الحجز</span> <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="block text-center w-full bg-gray-100 text-gray-600 font-bold py-4 rounded-xl hover:bg-gray-200 transition">سجل
                                        دخولك للحجز</a>
                                @endauth
                            </form>
                        @else
                            <div
                                class="bg-orange-50 text-orange-800 p-4 rounded-xl text-center font-bold border border-orange-200">
                                <i class="fa-solid fa-user-check"></i> هذه المعدة خاصة بك
                            </div>
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('items.edit', $item->id) }}"
                                    class="flex-1 bg-orange-50 text-orange-600 hover:bg-orange-500 hover:text-white py-2 rounded-lg text-center text-sm font-bold transition"><i
                                        class="fa-solid fa-pen-to-square"></i> تعديل</a>
                            </div>
                        @endif
                    </div>

                    {{-- بطاقة المالك --}}
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden mt-6">
                        <div class="p-6 bg-slate-50 border-b border-gray-100 flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-white flex items-center justify-center font-bold text-xl text-slate-800 overflow-hidden border-2 border-white shadow-md">
                                @if ($item->user->avatar)
                                    <img src="{{ $item->user->avatar }}" class="w-full h-full object-cover">
                                @else
                                    {{ substr($item->user->first_name, 0, 1) }}
                                @endif
                            </div>
                            <div>
                                <p class="text-[10px] font-extrabold text-orange-500 uppercase tracking-wider mb-1">مالك
                                    المعدة</p>
                                <h4 class="font-bold text-slate-900 text-md">{{ $item->user->first_name }}
                                    {{ $item->user->last_name }}</h4>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-sm text-gray-500 text-center mb-4 leading-relaxed">
                                <i class="fa-solid fa-lock text-gray-400 mb-2 block text-xl"></i>
                                بيانات الاتصال (رقم الهاتف) ستظهر لك تلقائياً بعد إرسال طلب الحجز لغرض التنسيق.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeImage(src) {
            const mainImg = document.getElementById('mainDisplayImage');
            mainImg.style.opacity = '0.5';
            setTimeout(() => {
                mainImg.src = src;
                mainImg.style.opacity = '1';
            }, 150);
        }

        const startDateInput = document.getElementById('startDate');
        const endDateInput = document.getElementById('endDate');
        const summaryDiv = document.getElementById('priceSummary');
        const daysCountSpan = document.getElementById('daysCount');
        const totalPriceSpan = document.getElementById('totalPrice');
        const rawPrice = document.getElementById('priceDisplay').innerText.replace(/,/g, '');
        const pricePerDay = parseFloat(rawPrice);

        function calculateTotal() {
            if (!startDateInput.value || !endDateInput.value) return;
            const start = new Date(startDateInput.value);
            const end = new Date(endDateInput.value);
            if (end > start) {
                const diffTime = Math.abs(end - start);
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                if (diffDays === 0) diffDays = 1;
                const total = diffDays * pricePerDay;
                daysCountSpan.innerText = diffDays;
                totalPriceSpan.innerText = new Intl.NumberFormat().format(total);
                summaryDiv.classList.remove('hidden');
            } else {
                summaryDiv.classList.add('hidden');
            }
        }

        if (startDateInput && endDateInput) {
            startDateInput.addEventListener('change', calculateTotal);
            endDateInput.addEventListener('change', calculateTotal);
        }
    </script>
@endsection
