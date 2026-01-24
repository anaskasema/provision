@extends('layouts.admin')

@section('title', 'إدارة المستخدمين')

@section('content')

    {{-- 1. الهيدر الكحلي الفخم --}}
    <div class="relative bg-slate-900 py-12 pb-28 rounded-3xl overflow-hidden shadow-lg mx-4 mt-4">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>

        <div class="relative z-10 px-8 flex flex-col md:flex-row justify-between items-end gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-2 flex items-center gap-3">
                    <i class="fa-solid fa-users text-orange-500"></i> كافة المستخدمين
                </h1>
                <p class="text-slate-400">إدارة شاملة للأعضاء، المزودين، والمشرفين.</p>
                <div
                    class="mt-4 inline-flex items-center gap-2 bg-slate-800/80 backdrop-blur border border-slate-700 rounded-full px-4 py-1.5 text-xs font-bold text-white shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    إجمالي الأعضاء: {{ $users->total() }}
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                {{-- زر الإضافة --}}
                <a href="{{ route('admin.users.create') }}"
                    class="h-12 px-6 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl font-bold flex items-center justify-center gap-2 transition shadow-lg shadow-orange-600/20 w-full md:w-auto hover:-translate-y-1">
                    <i class="fa-solid fa-user-plus"></i> <span class="whitespace-nowrap">إضافة جديد</span>
                </a>

                {{-- فورم البحث --}}
                <form action="{{ route('admin.users') }}" method="GET" class="relative flex-1 md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="بحث بالاسم، البريد..."
                        class="w-full h-12 pl-4 pr-12 rounded-2xl bg-white/10 border border-white/10 text-white placeholder-slate-400 focus:bg-white/20 focus:outline-none focus:ring-2 focus:ring-orange-500/50 transition font-medium">
                    <button type="submit"
                        class="absolute right-0 top-0 h-12 w-12 flex items-center justify-center text-slate-400 hover:text-white transition">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                @if (request('search'))
                    <a href="{{ route('admin.users') }}"
                        class="h-12 w-12 bg-white/10 hover:bg-white/20 text-white rounded-2xl flex items-center justify-center transition border border-white/10"
                        title="إلغاء البحث">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- 2. جدول البيانات --}}
    <div class="px-4 -mt-20 relative z-20 pb-20">
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-gray-100 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-right text-sm">
                    <thead
                        class="bg-slate-50/50 text-slate-500 font-extrabold border-b border-gray-100 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="p-6">العضو</th>
                            <th class="p-6">الصلاحية (Role)</th>
                            <th class="p-6">الحالة</th>
                            <th class="p-6">تاريخ الانضمام</th>
                            <th class="p-6 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($users as $user)
                            <tr class="hover:bg-orange-50/10 transition duration-200 group">

                                {{-- العضو --}}
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <div
                                                class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center font-extrabold text-slate-600 text-lg border border-slate-200 shadow-sm overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                                {{ substr($user->first_name, 0, 1) }}
                                            </div>
                                            @if ($user->role == 'admin')
                                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-white shadow-sm"
                                                    title="مدير النظام"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-900 text-base mb-0.5">{{ $user->first_name }}
                                                {{ $user->last_name }}</div>
                                            <div class="text-xs text-slate-400 font-mono tracking-wide">{{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- الصلاحية --}}
                                <td class="p-6">
                                    @if ($user->id === auth()->id())
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 px-3 py-1.5 rounded-xl text-xs font-bold border border-slate-200">
                                            <i class="fa-solid fa-user-check text-slate-400"></i> حسابك الحالي
                                        </span>
                                    @else
                                        {{-- ✅ تم تعديل الفورم هنا لاستخدام الجافاسكربت --}}
                                        <form action="{{ route('admin.users.role', $user->id) }}" method="POST"
                                            id="role-form-{{ $user->id }}">
                                            @csrf
                                            <div class="relative w-fit">
                                                <select name="role"
                                                    onchange="confirmAction(event, 'role-form-{{ $user->id }}', 'تغيير الصلاحية', 'هل أنت متأكد من تغيير صلاحية هذا العضو؟ سيؤثر هذا على إمكانياته في النظام.')"
                                                    class="appearance-none cursor-pointer text-xs font-bold py-1.5 pr-8 pl-3 rounded-xl border-0 ring-1 ring-inset focus:ring-2 focus:ring-orange-500 bg-transparent transition-all
                                                    {{ $user->role == 'admin' ? 'text-red-700 bg-red-50 ring-red-200 hover:bg-red-100' : ($user->role == 'provider' ? 'text-purple-700 bg-purple-50 ring-purple-200 hover:bg-purple-100' : 'text-slate-700 bg-slate-50 ring-slate-200 hover:bg-slate-100') }}">
                                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                                        مستأجر</option>
                                                    <option value="provider"
                                                        {{ $user->role == 'provider' ? 'selected' : '' }}>مزود خدمة
                                                    </option>
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                        مدير</option>
                                                </select>
                                                <i
                                                    class="fa-solid fa-chevron-down absolute left-2.5 top-1/2 -translate-y-1/2 text-[10px] opacity-50 pointer-events-none"></i>
                                            </div>
                                        </form>
                                    @endif
                                </td>

                                {{-- الحالة --}}
                                <td class="p-6">
                                    @if ($user->is_banned)
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 px-3 py-1.5 rounded-full text-xs font-bold border border-red-100 shadow-sm shadow-red-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span> محظور
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 px-3 py-1.5 rounded-full text-xs font-bold border border-green-100 shadow-sm shadow-green-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> نشط
                                        </span>
                                    @endif
                                </td>

                                {{-- التاريخ --}}
                                <td class="p-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-slate-600 font-bold text-xs dir-ltr">{{ $user->created_at->format('Y-m-d') }}</span>
                                        <span
                                            class="text-[10px] text-slate-400 mt-0.5">{{ $user->created_at->diffForHumans() }}</span>
                                    </div>
                                </td>

                                {{-- الإجراءات --}}
                                <td class="p-6 text-center">
                                    <div
                                        class="flex items-center justify-center gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">

                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                            class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-900 hover:text-white transition shadow-sm hover:shadow-md"
                                            title="عرض الملف الشخصي">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm hover:shadow-md hover:shadow-blue-200"
                                            title="تعديل البيانات">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        @if ($user->role !== 'admin' && $user->id !== auth()->id())
                                            {{-- ✅ تم تعديل زر الحظر هنا لاستخدام الجافاسكربت --}}
                                            <form action="{{ route('admin.users.ban', $user->id) }}" method="POST"
                                                class="m-0" id="ban-form-{{ $user->id }}">
                                                @csrf
                                                <button type="button"
                                                    onclick="confirmAction(event, 'ban-form-{{ $user->id }}', '{{ $user->is_banned ? 'فك الحظر' : 'حظر المستخدم' }}', '{{ $user->is_banned ? 'هل تريد استعادة صلاحيات هذا المستخدم؟' : 'سيتم منع هذا المستخدم من الدخول للنظام نهائياً.' }}', '{{ $user->is_banned ? 'success' : 'warning' }}')"
                                                    class="w-9 h-9 flex items-center justify-center rounded-xl border transition shadow-sm hover:shadow-md 
                                                    {{ $user->is_banned ? 'bg-green-50 text-green-600 border-green-200 hover:bg-green-600 hover:text-white hover:shadow-green-200' : 'bg-red-50 text-red-600 border-red-200 hover:bg-red-600 hover:text-white hover:shadow-red-200' }}"
                                                    title="{{ $user->is_banned ? 'فك الحظر' : 'حظر المستخدم' }}">
                                                    <i
                                                        class="fa-solid {{ $user->is_banned ? 'fa-lock-open' : 'fa-ban' }}"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-300">
                                            <i class="fa-solid fa-users-slash text-3xl"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-700 mb-1">لا يوجد مستخدمين</h3>
                                        <p class="text-slate-400 text-sm">لم يتم العثور على أي نتائج مطابقة للبحث.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- الترقيم --}}
            @if ($users->hasPages())
                <div class="p-6 border-t border-gray-100 bg-slate-50/50">
                    {{ $users->links() }}
                </div>
            @endif

        </div>
    </div>

    {{-- ✅ كود الجافاسكربت للنوافذ المنبثقة (SweetAlert2) --}}
    <script>
        function confirmAction(e, formId, title, text, icon = 'warning') {
            e.preventDefault(); // منع الإرسال المباشر

            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: '#0f172a', // لون كحلي (Slate-900)
                cancelButtonColor: '#f97316', // لون برتقالي (Orange-500)
                confirmButtonText: 'نعم، نفذ الإجراء',
                cancelButtonText: 'تراجع',
                customClass: {
                    popup: 'rounded-3xl font-sans', // تنسيق الزوايا والخط
                    confirmButton: 'rounded-xl px-6 py-3 font-bold',
                    cancelButton: 'rounded-xl px-6 py-3 font-bold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                } else {
                    // في حالة القائمة المنسدلة، إذا ضغط "تراجع" نعيد القيمة للسابق (اختياري)
                    if (e.target.tagName === 'SELECT') {
                        // e.target.value = e.target.getAttribute('data-original-value'); // يحتاج منطق إضافي
                        location.reload(); // أسهل حل لإعادة القيمة كما كانت
                    }
                }
            });
        }
    </script>

@endsection
