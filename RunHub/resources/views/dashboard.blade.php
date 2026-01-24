@extends('layouts.app')

@section('title', 'حجوزاتي')

@section('content')

    {{-- الهيدر العلوي: فخامة الكحلي --}}
    <div class="relative bg-slate-900 py-20 pb-32 overflow-hidden">
        {{-- خلفية جمالية --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>

        {{-- تأثيرات ضوئية --}}
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/5 backdrop-blur-md border border-white/20 mb-6 text-orange-500 shadow-2xl">
                <i class="fa-solid fa-box-open text-3xl"></i>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white mb-4">سجل طلباتي</h1>
            <p class="text-slate-400 max-w-xl mx-auto text-lg leading-relaxed">
                مرحباً {{ Auth::user()->first_name }}، هنا يمكنك متابعة حالة طلباتك والعقود.
            </p>
        </div>
    </div>

    {{-- المحتوى الرئيسي --}}
    <div class="container mx-auto px-4 -mt-20 relative z-20 pb-20">

        {{-- ملاحظة: تم حذف كود عرض الرسائل من هنا لأن الـ Component العام في Layout سيقوم بعرضها تلقائياً --}}

        <div class="max-w-5xl mx-auto space-y-6">

            @if ($bookings->count() > 0)
                @foreach ($bookings as $booking)
                    {{-- كرت الحجز --}}
                    <div
                        class="bg-white rounded-3xl p-5 shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 group relative overflow-hidden">

                        {{-- شريط جانبي ملون حسب الحالة --}}
                        <div
                            class="absolute right-0 top-0 bottom-0 w-1.5 
                            {{ $booking->status == 'confirmed' ? 'bg-green-500' : ($booking->status == 'pending' ? 'bg-yellow-400' : ($booking->status == 'completed' ? 'bg-blue-500' : 'bg-red-500')) }}">
                        </div>

                        <div class="flex flex-col md:flex-row gap-6">

                            {{-- صورة المعدة --}}
                            <div
                                class="w-full md:w-48 h-32 md:h-auto flex-shrink-0 relative rounded-2xl overflow-hidden bg-gray-100">
                                @if ($booking->item)
                                    @php
                                        $images = is_string($booking->item->images)
                                            ? json_decode($booking->item->images, true)
                                            : $booking->item->images;
                                        $img = !empty($images) ? asset($images[0]) : 'https://via.placeholder.com/300';
                                    @endphp
                                    <img src="{{ $img }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <i class="fa-solid fa-image-slash text-2xl"></i>
                                    </div>
                                @endif
                            </div>

                            {{-- التفاصيل --}}
                            <div class="flex-1 py-2">
                                <div
                                    class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                                    <div>
                                        <h3
                                            class="text-xl font-black text-slate-900 group-hover:text-orange-600 transition-colors">
                                            {{ $booking->item ? $booking->item->title : 'معدة غير متوفرة' }}
                                        </h3>
                                        <p class="text-xs text-gray-400 font-bold mt-1">طلب #{{ $booking->id }} •
                                            {{ $booking->created_at->diffForHumans() }}</p>
                                    </div>

                                    {{-- حالة الطلب --}}
                                    @if ($booking->status == 'pending')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-yellow-50 text-yellow-700 text-xs font-bold border border-yellow-200">
                                            <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span> بانتظار
                                            الموافقة
                                        </span>
                                    @elseif($booking->status == 'confirmed')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-green-50 text-green-700 text-xs font-bold border border-green-200">
                                            <i class="fa-solid fa-check-circle"></i> تم التأكيد (جاري التنفيذ)
                                        </span>
                                    @elseif($booking->status == 'completed')
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold border border-blue-200">
                                            <i class="fa-solid fa-flag-checkered"></i> مكتمل
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-red-50 text-red-700 text-xs font-bold border border-red-200">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            {{ $booking->status == 'cancelled' ? 'ملغي' : 'مرفوض' }}
                                        </span>
                                    @endif
                                </div>

                                {{-- معلومات الحجز --}}
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div class="bg-gray-50 p-2 rounded-xl text-center">
                                        <span class="block text-[10px] text-gray-400 font-bold mb-1">تاريخ الاستلام</span>
                                        <span
                                            class="text-sm font-bold text-slate-800">{{ $booking->start_date->format('Y-m-d') }}</span>
                                    </div>
                                    <div class="bg-gray-50 p-2 rounded-xl text-center">
                                        <span class="block text-[10px] text-gray-400 font-bold mb-1">تاريخ الإرجاع</span>
                                        <span
                                            class="text-sm font-bold text-slate-800">{{ $booking->end_date->format('Y-m-d') }}</span>
                                    </div>
                                    <div class="bg-gray-50 p-2 rounded-xl text-center">
                                        <span class="block text-[10px] text-gray-400 font-bold mb-1">المدة</span>
                                        <span
                                            class="text-sm font-bold text-slate-800">{{ $booking->start_date->diffInDays($booking->end_date) ?: 1 }}
                                            يوم</span>
                                    </div>
                                    <div class="bg-orange-50 p-2 rounded-xl text-center border border-orange-100">
                                        <span class="block text-[10px] text-orange-400 font-bold mb-1">الإجمالي</span>
                                        <span
                                            class="text-sm font-black text-orange-600">{{ number_format($booking->total_price) }}
                                            YER</span>
                                    </div>
                                </div>

                                {{-- أزرار الإجراءات --}}
                                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-50">

                                    {{-- تواصل واتساب --}}
                                    @if (in_array($booking->status, ['confirmed', 'completed']) && $booking->item && $booking->item->user->phone)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->item->user->phone) }}"
                                            target="_blank"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white rounded-xl text-xs font-bold hover:bg-green-600 transition shadow-md shadow-green-500/20">
                                            <i class="fa-brands fa-whatsapp text-lg"></i> تواصل مع المالك
                                        </a>
                                    @endif

                                    {{-- العقد --}}
                                    @if (in_array($booking->status, ['confirmed', 'completed']))
                                        <a href="{{ route('bookings.contract', $booking->id) }}" target="_blank"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 text-white rounded-xl text-xs font-bold hover:bg-slate-900 transition shadow-md">
                                            <i class="fa-solid fa-file-contract"></i> العقد الإلكتروني
                                        </a>
                                    @endif

                                    {{-- زر الإلغاء (للمعلق فقط) --}}
                                    @if ($booking->status == 'pending')
                                        <form id="cancel-form-{{ $booking->id }}"
                                            action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                                            @csrf
                                            {{-- استدعاء دالة التأكيد --}}
                                            <button type="button" onclick="confirmAction('cancel', '{{ $booking->id }}')"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-500 hover:text-white transition border border-red-100">
                                                <i class="fa-solid fa-xmark"></i> إلغاء الطلب
                                            </button>
                                        </form>
                                    @endif

                                    {{-- زر الحذف من السجل (للملغي والمرفوض والمكتمل) --}}
                                    @if (in_array($booking->status, ['cancelled', 'rejected', 'completed']))
                                        <form id="delete-form-{{ $booking->id }}"
                                            action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- استدعاء دالة التأكيد --}}
                                            <button type="button" onclick="confirmAction('delete', '{{ $booking->id }}')"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-500 rounded-xl text-xs font-bold hover:bg-red-500 hover:text-white transition"
                                                title="حذف من السجل">
                                                <i class="fa-regular fa-trash-can"></i> حذف
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- الحالة الفارغة --}}
                <div class="text-center py-24 bg-white rounded-[2.5rem] shadow-xl border border-gray-100">
                    <div
                        class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-300 border-4 border-slate-100">
                        <i class="fa-regular fa-calendar-xmark text-5xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">لا توجد حجوزات حتى الآن</h3>
                    <p class="text-gray-500 mb-8">ابدأ بتصفح المعدات وقم بأول طلب حجز لك الآن.</p>
                    <a href="{{ route('items.index') }}"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-orange-600 transition shadow-lg hover:-translate-y-1">
                        <i class="fa-solid fa-magnifying-glass"></i> تصفح المعدات
                    </a>
                </div>
            @endif

        </div>
    </div>

    {{-- 🔥 سكربت SweetAlert للتأكيد قبل الحذف/الإلغاء (هذا ضروري هنا لأنه مرتبط بالأزرار) 🔥 --}}
    <script>
        function confirmAction(type, id) {
            let title = '';
            let text = '';
            let confirmBtnColor = '';
            let confirmBtnText = '';
            let icon = '';
            let formId = '';

            if (type === 'cancel') {
                title = 'هل أنت متأكد من الإلغاء؟';
                text = 'سيتم إلغاء طلب الحجز المعلق هذا.';
                confirmBtnColor = '#f59e0b'; // لون برتقالي للإلغاء
                confirmBtnText = 'نعم، الغِ الطلب';
                icon = 'question';
                formId = 'cancel-form-' + id;
            } else if (type === 'delete') {
                title = 'حذف السجل نهائياً؟';
                text = 'لن تتمكن من استعادة بيانات هذا الحجز بعد حذفه من سجلك.';
                confirmBtnColor = '#dc2626'; // لون أحمر للحذف
                confirmBtnText = 'نعم، احذف السجل';
                icon = 'warning';
                formId = 'delete-form-' + id;
            }

            // ظهور نافذة السؤال "هل أنت متأكد؟"
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmBtnColor,
                cancelButtonColor: '#64748b',
                confirmButtonText: confirmBtnText,
                cancelButtonText: 'تراجع',
                background: '#fff',
                customClass: {
                    popup: 'rounded-3xl shadow-xl'
                }
            }).then((result) => {
                // إذا ضغط نعم، يتم إرسال الفورم
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            })
        }
    </script>

@endsection
