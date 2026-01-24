@extends('layouts.admin')

@section('title', 'إعدادات النظام')

@section('content')

    {{-- 1. الهيدر الكحلي الفخم --}}
    <div class="relative bg-slate-900 py-12 pb-24 rounded-3xl overflow-hidden shadow-lg mx-4 mt-4">
        {{-- الخلفية والنقشات --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
        </div>

        <div class="relative z-10 px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-white mb-2 flex items-center gap-3">
                    <i class="fa-solid fa-gears text-orange-500"></i> إعدادات المنصة
                </h1>
                <p class="text-slate-400 font-medium">تحكم في هوية الموقع، بيانات التواصل، وحالة النظام بشكل كامل.</p>
            </div>

            <div class="bg-white/5 backdrop-blur-md border border-white/10 p-4 rounded-2xl flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-orange-500/20 flex items-center justify-center text-orange-500">
                    <i class="fa-solid fa-server"></i>
                </div>
                <div class="text-right">
                    <p class="text-white text-xs font-bold uppercase tracking-wider">نسخة النظام</p>
                    <p class="text-slate-400 text-[10px] font-mono">v1.0.0-stable</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. المحتوى المتداخل --}}
    <div class="px-4 -mt-16 relative z-20 pb-20">
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">

                {{-- الجانب الأيمن: التحكم المركزي --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- كرت وضع الصيانة --}}
                    <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden">
                        <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                <i class="fa-solid fa-power-off text-orange-500"></i> حالة النظام
                            </h3>
                        </div>
                        <div class="p-8">
                            <div
                                class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100 mb-6">
                                <span class="text-sm font-black text-slate-700 uppercase tracking-tight">وضع الصيانة</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="maintenance_mode" value="0">
                                    <input type="checkbox" name="maintenance_mode" value="1" class="sr-only peer"
                                        {{ isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == 1 ? 'checked' : '' }}>
                                    <div
                                        class="w-14 h-7 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-6 after:transition-all peer-checked:bg-orange-600">
                                    </div>
                                </label>
                            </div>
                            <div class="flex gap-3 bg-orange-50 p-4 rounded-2xl border border-orange-100">
                                <i class="fa-solid fa-circle-exclamation text-orange-600 mt-1"></i>
                                <p class="text-xs text-orange-800 leading-relaxed font-medium">
                                    تفعيل وضع الصيانة سيمنع جميع المستخدمين من تصفح الموقع، وسيظهر لهم رسالة تفيد بأن الموقع
                                    قيد التطوير حالياً.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- زر الحفظ العائم --}}
                    <div class="sticky top-24">
                        <button type="submit"
                            class="w-full bg-slate-900 text-white py-5 rounded-[1.5rem] font-black hover:bg-slate-800 transition-all shadow-2xl shadow-slate-900/30 hover:-translate-y-1 flex justify-center items-center gap-3 text-lg group">
                            <i class="fa-solid fa-cloud-arrow-up text-orange-500 group-hover:animate-bounce"></i>
                            تحديث الإعدادات
                        </button>
                        <p class="text-center text-[10px] text-slate-400 font-bold uppercase mt-4 tracking-widest italic">
                            آخر تحديث: {{ now()->format('Y-m-d') }}</p>
                    </div>
                </div>

                {{-- الجانب الأيسر: الإعدادات التفصيلية --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- الهوية البصرية --}}
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
                        <div class="p-8 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-orange-500 text-white flex items-center justify-center shadow-lg shadow-orange-500/20">
                                    <i class="fa-solid fa-palette"></i>
                                </div>
                                <h3 class="font-black text-slate-900 text-lg uppercase tracking-tight">الهوية البصرية</h3>
                            </div>
                        </div>

                        <div class="p-8 space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label
                                        class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-widest">اسم
                                        المنصة</label>
                                    <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'RentHub' }}"
                                        class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-3.5 focus:outline-none focus:border-slate-900 focus:bg-white transition font-black text-slate-800">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-widest">شعار
                                        الموقع (Logo)</label>
                                    <div class="flex items-center gap-4">
                                        @if (isset($settings['site_logo']))
                                            <div
                                                class="w-16 h-16 bg-slate-900 rounded-2xl border-2 border-slate-800 flex items-center justify-center p-2 shrink-0 shadow-lg">
                                                <img src="{{ asset($settings['site_logo']) }}"
                                                    class="max-w-full max-h-full object-contain">
                                            </div>
                                        @endif
                                        <div class="relative w-full">
                                            <input type="file" name="site_logo"
                                                class="absolute inset-0 opacity-0 cursor-pointer z-10">
                                            <div
                                                class="w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl px-4 py-3 flex items-center justify-center gap-2 text-slate-400 font-bold text-xs hover:bg-slate-100 transition">
                                                <i class="fa-solid fa-upload"></i> اختر ملف جديد
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-widest">وصف
                                    الموقع للبحث (SEO Meta)</label>
                                <textarea name="site_description" rows="3"
                                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-4 focus:outline-none focus:border-slate-900 focus:bg-white transition font-medium text-slate-600 leading-relaxed">{{ $settings['site_description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- بيانات التواصل --}}
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
                        <div class="p-8 border-b border-slate-50 bg-slate-50/50 flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/20">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                            <h3 class="font-black text-slate-900 text-lg uppercase tracking-tight">بيانات التواصل</h3>
                        </div>

                        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="relative group">
                                <label class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-widest">البريد
                                    الرسمي</label>
                                <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-3.5 pr-12 focus:outline-none focus:border-blue-600 focus:bg-white transition text-slate-800 font-mono">
                                <i
                                    class="fa-solid fa-envelope absolute right-4 top-[2.7rem] text-slate-300 group-focus-within:text-blue-500 transition-colors"></i>
                            </div>
                            <div class="relative group">
                                <label class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-widest">رقم
                                    خدمة العملاء</label>
                                <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}"
                                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-3.5 pr-12 focus:outline-none focus:border-blue-600 focus:bg-white transition text-slate-800 font-mono dir-ltr text-right">
                                <i
                                    class="fa-solid fa-phone absolute right-4 top-[2.7rem] text-slate-300 group-focus-within:text-blue-500 transition-colors"></i>
                            </div>
                            <div class="md:col-span-2 relative group">
                                <label
                                    class="block text-xs font-black text-slate-400 uppercase mb-3 tracking-widest">العنوان
                                    الرئيسي</label>
                                <input type="text" name="contact_address"
                                    value="{{ $settings['contact_address'] ?? '' }}"
                                    class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-3.5 pr-12 focus:outline-none focus:border-blue-600 focus:bg-white transition text-slate-800">
                                <i
                                    class="fa-solid fa-location-dot absolute right-4 top-[2.7rem] text-slate-300 group-focus-within:text-blue-500 transition-colors"></i>
                            </div>
                        </div>
                    </div>

                    {{-- التواصل الاجتماعي --}}
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden">
                        <div class="p-8 border-b border-slate-50 bg-slate-50/50 flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-500/20">
                                <i class="fa-solid fa-share-nodes"></i>
                            </div>
                            <h3 class="font-black text-slate-900 text-lg uppercase tracking-tight">التواجد الاجتماعي</h3>
                        </div>

                        <div class="p-8 space-y-6">
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shadow-sm transition-transform group-hover:scale-110">
                                    <i class="fa-brands fa-facebook"></i>
                                </div>
                                <input type="url" name="social_facebook"
                                    value="{{ $settings['social_facebook'] ?? '' }}" placeholder="Facebook URL"
                                    class="flex-1 bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-3.5 focus:outline-none focus:border-blue-600 transition font-medium">
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-500 flex items-center justify-center text-2xl shadow-sm transition-transform group-hover:scale-110">
                                    <i class="fa-brands fa-twitter"></i>
                                </div>
                                <input type="url" name="social_twitter"
                                    value="{{ $settings['social_twitter'] ?? '' }}" placeholder="Twitter URL"
                                    class="flex-1 bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-3.5 focus:outline-none focus:border-sky-500 transition font-medium">
                            </div>
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600 text-white flex items-center justify-center text-2xl shadow-sm transition-transform group-hover:scale-110">
                                    <i class="fa-brands fa-instagram"></i>
                                </div>
                                <input type="url" name="social_instagram"
                                    value="{{ $settings['social_instagram'] ?? '' }}" placeholder="Instagram URL"
                                    class="flex-1 bg-slate-50 border-2 border-slate-100 rounded-2xl px-5 py-3.5 focus:outline-none focus:border-pink-500 transition font-medium">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
