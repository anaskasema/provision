@extends('layouts.admin')

@section('title', 'لوحة القيادة')

@section('content')

    {{-- ========================================================= --}}
    {{-- 1. الهيدر الكحلي الفخم (Hero Section) --}}
    {{-- ========================================================= --}}
    <div class="relative bg-slate-900 py-12 pb-32 rounded-3xl overflow-hidden shadow-lg mx-4 mt-4">
        {{-- الخلفية والنقشات --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none">
        </div>

        <div class="relative z-10 px-8 flex flex-col xl:flex-row justify-between items-end gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-2 flex items-center gap-3">
                    <i class="fa-solid fa-chart-pie text-orange-500"></i> ملخص الأداء
                </h1>
                <p class="text-slate-400">أهلاً بك، إليك نظرة شاملة على إحصائيات المنصة والنمو المالي.</p>
            </div>

            {{-- فلتر التاريخ (داخل الهيدر بشكل أنيق) --}}
            <form action="{{ route('admin.dashboard') }}" method="GET"
                class="bg-white/10 backdrop-blur-md border border-white/10 p-1.5 rounded-2xl flex flex-col md:flex-row gap-2 shadow-lg w-full md:w-auto">

                <div class="relative group flex-1">
                    <span class="absolute top-1 right-3 text-[10px] text-slate-400 font-bold uppercase">من</span>
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                        class="w-full bg-slate-800/80 text-white border-0 rounded-xl px-4 pt-5 pb-1.5 text-sm font-bold focus:ring-2 focus:ring-orange-500 transition cursor-pointer group-hover:bg-slate-800">
                </div>

                <div class="relative group flex-1">
                    <span class="absolute top-1 right-3 text-[10px] text-slate-400 font-bold uppercase">إلى</span>
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                        class="w-full bg-slate-800/80 text-white border-0 rounded-xl px-4 pt-5 pb-1.5 text-sm font-bold focus:ring-2 focus:ring-orange-500 transition cursor-pointer group-hover:bg-slate-800">
                </div>

                <button type="submit"
                    class="bg-orange-600 hover:bg-orange-500 text-white px-6 py-2 rounded-xl font-bold text-sm transition shadow-lg shadow-orange-600/20 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-filter"></i> <span class="hidden md:inline">تحديث</span>
                </button>

                @if (request('start_date') || request('end_date'))
                    <a href="{{ route('admin.dashboard') }}"
                        class="bg-white/5 hover:bg-white/10 text-slate-300 px-4 py-2 rounded-xl font-bold text-sm transition border border-white/5 flex items-center justify-center"
                        title="إلغاء الفلتر">
                        <i class="fa-solid fa-rotate-left"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- 2. المحتوى المتداخل (-mt-24) --}}
    {{-- ========================================================= --}}
    <div class="px-4 -mt-24 relative z-20 pb-20">

        {{-- بطاقات الإحصائيات --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

            {{-- الإيرادات --}}
            <div
                class="bg-gradient-to-br from-emerald-600 to-teal-800 p-6 rounded-[2.5rem] shadow-xl relative overflow-hidden group hover:-translate-y-2 transition duration-300 text-white border border-white/10">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-xl shadow-inner">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                        <span
                            class="bg-emerald-500/30 px-2 py-1 rounded-lg text-[10px] font-bold border border-white/10">المفلترة</span>
                    </div>
                    <p class="text-emerald-100 text-xs font-bold uppercase tracking-wider mb-1">صافي الإيرادات</p>
                    <h3 class="text-3xl font-extrabold tracking-tight">{{ number_format($stats['revenue']) }} <span
                            class="text-sm font-medium opacity-80">YER</span></h3>
                </div>
                <div
                    class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-110 transition-transform duration-500">
                </div>
            </div>

            {{-- الحجوزات --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] shadow-xl border border-slate-100 relative overflow-hidden group hover:-translate-y-2 transition duration-300">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">الحجوزات الناجحة</p>
                    <h3 class="text-3xl font-extrabold text-slate-900">{{ $stats['bookings_count'] }}</h3>
                </div>
                <div
                    class="absolute -right-6 -bottom-6 w-24 h-24 bg-blue-50 rounded-full opacity-50 blur-xl group-hover:bg-blue-100 transition-colors">
                </div>
            </div>

            {{-- الأعضاء الجدد --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] shadow-xl border border-slate-100 relative overflow-hidden group hover:-translate-y-2 transition duration-300">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-purple-600 text-xl group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <span class="bg-purple-50 text-purple-600 px-2 py-1 rounded-lg text-[10px] font-bold">جديد</span>
                    </div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">التسجيلات الجديدة</p>
                    <h3 class="text-3xl font-extrabold text-slate-900">{{ $stats['new_users'] }}</h3>
                </div>
                <div
                    class="absolute -right-6 -bottom-6 w-24 h-24 bg-purple-50 rounded-full opacity-50 blur-xl group-hover:bg-purple-100 transition-colors">
                </div>
            </div>

            {{-- إجمالي المستخدمين --}}
            <div
                class="bg-white p-6 rounded-[2.5rem] shadow-xl border border-slate-100 relative overflow-hidden group hover:-translate-y-2 transition duration-300">
                <div class="relative z-10">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600 text-xl group-hover:bg-orange-600 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">إجمالي المستخدمين</p>
                    <h3 class="text-3xl font-extrabold text-slate-900">{{ $stats['total_users'] }}</h3>
                </div>
                <div
                    class="absolute -right-6 -bottom-6 w-24 h-24 bg-orange-50 rounded-full opacity-50 blur-xl group-hover:bg-orange-100 transition-colors">
                </div>
            </div>
        </div>

        {{-- الرسم البياني والجداول --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- الرسم البياني (عريض) --}}
            <div class="lg:col-span-2 bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-8">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center"><i
                                class="fa-solid fa-chart-area"></i></div>
                        التحليل المالي
                    </h3>
                    <div
                        class="flex items-center gap-2 text-xs font-bold text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg">
                        <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span> الإيرادات اليومية
                    </div>
                </div>
                <div class="relative h-80 w-full">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            {{-- آخر الحجوزات (طولي) --}}
            <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-900">آخر العمليات</h3>
                    <a href="{{ route('admin.bookings') }}"
                        class="text-xs font-bold text-orange-600 hover:text-orange-700 hover:underline">عرض السجل</a>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-3 custom-scrollbar" style="max-height: 400px;">
                    @foreach ($recentBookings as $booking)
                        <div
                            class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 hover:border-orange-200 hover:shadow-md transition duration-200 group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 text-xs shrink-0 border border-slate-200 group-hover:border-orange-200 transition">
                                    {{ substr($booking->user->first_name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 text-sm group-hover:text-orange-600 transition">
                                        {{ $booking->user->first_name }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold flex items-center gap-1">
                                        <i class="fa-regular fa-clock"></i> {{ $booking->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span
                                    class="block font-extrabold text-slate-900 text-sm">{{ number_format($booking->total_price) }}</span>
                                <span
                                    class="text-[10px] font-bold px-2 py-0.5 rounded-full inline-block mt-1 
                                    {{ $booking->status == 'completed' ? 'bg-green-50 text-green-600' : ($booking->status == 'confirmed' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600') }}">
                                    {{ $booking->status }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- سكريبت الشارت --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');

        // تدرج لوني فخم للشارت
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(249, 115, 22, 0.4)'); // برتقالي قوي في الأعلى
        gradient.addColorStop(1, 'rgba(249, 115, 22, 0.0)'); // شفاف في الأسفل

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'الإيرادات',
                    data: @json($chartValues),
                    borderColor: '#f97316',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#f97316',
                    pointBorderWidth: 3,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.4 // منحنى ناعم
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: {
                            family: 'Almarai',
                            size: 13
                        },
                        bodyFont: {
                            family: 'Almarai',
                            size: 14,
                            weight: 'bold'
                        },
                        cornerRadius: 10,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y.toLocaleString() + ' YER';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        border: {
                            display: false
                        },
                        grid: {
                            color: '#f1f5f9',
                            borderDash: [8, 8]
                        },
                        ticks: {
                            font: {
                                family: 'Almarai',
                                size: 11
                            },
                            color: '#94a3b8',
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        border: {
                            display: false
                        },
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Almarai',
                                size: 11
                            },
                            color: '#94a3b8'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    </script>
@endsection
