@extends('layouts.admin')

@section('title', 'الرسائل الواردة')

@section('content')

    {{-- 1. الهيدر الكحلي (تم توحيد المقاس مع باقي الصفحات) --}}
    <div class="relative bg-slate-900 py-12 pb-28 rounded-3xl overflow-hidden shadow-lg mx-4 mt-4">
        {{-- الخلفية --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none">
        </div>

        <div class="relative z-10 px-8 flex flex-col items-center text-center">
            {{-- العنوان والوصف --}}
            <h1 class="text-3xl font-extrabold text-white mb-2 flex items-center gap-3">
                <i class="fa-solid fa-envelope-open-text text-orange-500"></i> الرسائل الواردة
            </h1>
            <p class="text-slate-400 max-w-xl mx-auto text-sm">
                مركز استقبال استفسارات الزوار والمشاكل الواردة من نموذج "اتصل بنا".
            </p>

            {{-- العداد --}}
            <div
                class="mt-4 inline-flex items-center gap-2 bg-slate-800/80 backdrop-blur border border-slate-700 rounded-full px-4 py-1.5 text-xs font-bold text-white shadow-sm">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                عدد الرسائل: {{ $messages->total() }}
            </div>
        </div>
    </div>

    {{-- 2. قائمة الرسائل --}}
    <div class="container mx-auto px-4 -mt-20 relative z-20 pb-20">

        <div class="flex flex-col gap-6">
            @forelse($messages as $msg)
                {{-- بطاقة الرسالة --}}
                <div
                    class="bg-white rounded-[2rem] p-6 md:p-8 shadow-xl border border-gray-100 hover:shadow-2xl hover:border-orange-200 transition-all duration-300 transform hover:-translate-y-1 group">
                    <div class="flex flex-col md:flex-row gap-6">

                        {{-- الجانب الأيمن: معلومات المرسل --}}
                        <div
                            class="md:w-1/4 flex flex-row md:flex-col items-center md:items-start gap-4 border-b md:border-b-0 md:border-l border-gray-100 pb-4 md:pb-0 md:pl-6">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center font-black text-slate-600 text-xl border border-slate-300 shadow-inner shrink-0 group-hover:from-slate-800 group-hover:to-slate-900 group-hover:text-orange-500 transition-all duration-300">
                                {{ substr($msg->name, 0, 1) }}
                            </div>
                            <div class="overflow-hidden text-center md:text-right w-full">
                                <h4 class="font-bold text-slate-900 text-lg truncate w-full" title="{{ $msg->name }}">
                                    {{ $msg->name }}</h4>
                                <a href="mailto:{{ $msg->email }}"
                                    class="text-xs text-slate-500 hover:text-orange-600 font-mono bg-slate-50 px-2 py-1 rounded border border-slate-100 inline-block mt-1 transition">
                                    {{ $msg->email }}
                                </a>
                                <div
                                    class="text-[11px] text-gray-400 font-bold flex items-center justify-center md:justify-start gap-1 mt-2">
                                    <i class="fa-regular fa-clock"></i> {{ $msg->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>

                        {{-- الجانب الأوسط: محتوى الرسالة --}}
                        <div class="flex-1">
                            <div
                                class="relative bg-slate-50 rounded-2xl p-6 border border-slate-100 group-hover:bg-orange-50/30 group-hover:border-orange-100 transition-colors h-full">
                                {{-- علامة اقتباس جمالية --}}
                                <i
                                    class="fa-solid fa-quote-right absolute top-4 right-4 text-slate-200 text-4xl opacity-50 group-hover:text-orange-200 transition-colors"></i>

                                <p class="text-slate-700 leading-loose text-sm font-medium relative z-10 text-justify">
                                    {{ $msg->message }}
                                </p>
                            </div>
                        </div>

                        {{-- الجانب الأيسر: الإجراءات --}}
                        <div class="md:w-auto flex md:flex-col justify-center gap-3 shrink-0">
                            {{-- زر الرد --}}
                            <a href="mailto:{{ $msg->email }}?subject=رد: استفسار RentHub"
                                class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-blue-50 text-blue-600 border border-blue-100 px-5 py-3 rounded-xl text-sm font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm hover:shadow-md">
                                <i class="fa-solid fa-reply"></i> <span class="hidden md:inline">رد</span>
                            </a>

                            {{-- زر الحذف (مع SweetAlert2) --}}
                            <form action="{{ route('admin.messages.delete', $msg->id) }}" method="POST"
                                id="delete-msg-{{ $msg->id }}" class="flex-1 md:flex-none">
                                @csrf @method('DELETE')
                                <button type="button"
                                    onclick="confirmAction(event, 'delete-msg-{{ $msg->id }}', 'حذف الرسالة', 'هل أنت متأكد من حذف هذه الرسالة نهائياً؟', 'warning')"
                                    class="w-full flex items-center justify-center gap-2 bg-white text-red-500 border border-red-100 px-5 py-3 rounded-xl text-sm font-bold hover:bg-red-500 hover:text-white hover:border-red-500 transition-all shadow-sm hover:shadow-md">
                                    <i class="fa-regular fa-trash-can"></i> <span class="hidden md:inline">حذف</span>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                {{-- الحالة الفارغة --}}
                <div class="bg-white rounded-[3rem] p-16 text-center border border-dashed border-gray-200 shadow-sm">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-envelope-circle-check text-5xl text-slate-300"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-2">صندوق الوارد فارغ</h3>
                    <p class="text-slate-500">رائع! لا توجد رسائل جديدة أو استفسارات معلقة حالياً.</p>
                </div>
            @endforelse
        </div>

        {{-- الترقيم --}}
        @if ($messages->hasPages())
            <div class="mt-8 p-4 bg-white/50 backdrop-blur rounded-2xl border border-white/20">
                {{ $messages->links() }}
            </div>
        @endif

    </div>

    {{-- سكريبت التنبيهات (SweetAlert2) --}}
    <script>
        function confirmAction(e, formId, title, text, icon = 'warning') {
            e.preventDefault();
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#0f172a',
                confirmButtonText: 'نعم، احذفها',
                cancelButtonText: 'تراجع',
                customClass: {
                    popup: 'rounded-3xl font-sans shadow-2xl',
                    title: 'text-xl font-bold',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

@endsection
