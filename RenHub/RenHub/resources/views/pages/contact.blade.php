@extends('layouts.app')

@section('title', 'اتصل بنا')

@section('content')

    {{-- 1. الهيدر: فخامة الكحلي مع لمسة برتقالية --}}
    <div class="relative bg-slate-900 py-24 lg:py-32 overflow-hidden">
        {{-- النقشة الخلفية --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0">
        </div>

        {{-- تأثير ضوئي خلفي --}}
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-md border border-white/10 rounded-full text-orange-500 text-xs font-black mb-6 uppercase tracking-widest animate-fade-in">
                <span class="w-2 h-2 bg-orange-500 rounded-full animate-ping"></span>
                نحن هنا لأجلك
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight drop-shadow-2xl">
                كيف يمكننا <span class="text-orange-500">مساعدتك؟</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto font-medium leading-relaxed">
                سواء كان لديك استفسار، مشكلة تقنية، أو حتى اقتراح لتطوير المنصة، فريقنا يسعد دائماً بالتواصل معك.
            </p>
        </div>
    </div>

    {{-- 2. قسم المحتوى الرئيسي --}}
    <div class="container mx-auto px-4 -mt-20 relative z-20 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">

            {{-- كرت معلومات التواصل (الجانب الأيمن) --}}
            <div
                class="bg-slate-800 text-white rounded-[2.5rem] p-8 lg:p-12 shadow-2xl flex flex-col justify-between h-full relative overflow-hidden border border-white/10 group">

                {{-- نقشة داخلية خفيفة جداً --}}
                <div
                    class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5 z-0">
                </div>

                <div class="relative z-10">
                    <h3 class="text-2xl font-black mb-4">قنوات التواصل</h3>
                    <p class="text-slate-400 mb-12 text-sm leading-relaxed">يسعدنا استقبالك في مقرنا أو الرد على استفساراتك
                        عبر القنوات الرسمية:</p>

                    <div class="space-y-10">
                        {{-- الموقع --}}
                        <div class="flex items-start gap-6 group/item">
                            <div
                                class="w-14 h-14 rounded-2xl bg-white/5 flex items-center justify-center text-orange-500 text-2xl border border-white/10 shrink-0 shadow-xl group-hover/item:bg-orange-600 group-hover/item:text-white transition-all duration-500 transform group-hover/item:rotate-12">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <p class="font-black text-lg text-white">المقر الرئيسي</p>
                                <p class="text-slate-400 text-sm leading-relaxed mt-1">اليمن، صنعاء - شارع حدة<br>برج
                                    الأعمال، الدور الرابع</p>
                            </div>
                        </div>

                        {{-- الهاتف --}}
                        <div class="flex items-start gap-6 group/item">
                            <div
                                class="w-14 h-14 rounded-2xl bg-white/5 flex items-center justify-center text-orange-500 text-2xl border border-white/10 shrink-0 shadow-xl group-hover/item:bg-orange-600 group-hover/item:text-white transition-all duration-500 transform group-hover/item:rotate-12">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div>
                                <p class="font-black text-lg text-white">الدعم الهاتفي</p>
                                <p class="text-slate-400 text-sm mt-1 dir-ltr hover:text-orange-400 transition"
                                    dir="ltr">+967 777 000 000</p>
                                <p class="text-slate-500 text-[10px] font-bold mt-1 uppercase tracking-tighter">متاح: 8:00 ص
                                    - 10:00 م</p>
                            </div>
                        </div>

                        {{-- البريد --}}
                        <div class="flex items-start gap-6 group/item">
                            <div
                                class="w-14 h-14 rounded-2xl bg-white/5 flex items-center justify-center text-orange-500 text-2xl border border-white/10 shrink-0 shadow-xl group-hover/item:bg-orange-600 group-hover/item:text-white transition-all duration-500 transform group-hover/item:rotate-12">
                                <i class="fa-solid fa-envelope-open-text"></i>
                            </div>
                            <div>
                                <p class="font-black text-lg text-white">البريد الإلكتروني</p>
                                <p class="text-slate-400 text-sm mt-1 hover:text-orange-400 transition">support@renthub.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- روابط التواصل الاجتماعي --}}
                <div class="relative z-10 mt-16 pt-8 border-t border-white/10">
                    <p class="text-xs font-bold text-slate-500 mb-6 uppercase tracking-widest text-center">تابع رحلتنا</p>
                    <div class="flex justify-center gap-4">
                        @foreach (['facebook-f', 'twitter', 'instagram', 'linkedin-in'] as $social)
                            <a href="#"
                                class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:bg-orange-600 hover:text-white hover:border-orange-600 transition-all duration-300 hover:-translate-y-2 shadow-lg">
                                <i class="fa-brands fa-{{ $social }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- نموذج التواصل (الجانب الأيسر) --}}
            <div
                class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 lg:p-14 shadow-2xl border border-gray-100 relative overflow-hidden">
                {{-- خلفية جمالية خفيفة جداً --}}
                <div class="absolute top-0 left-0 w-32 h-32 bg-orange-500/5 rounded-full blur-3xl"></div>

                <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-4">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 mb-2">أرسل رسالة الآن</h2>
                        <p class="text-gray-500 font-medium">سيرد عليك أحد مستشارينا في أقل من 24 ساعة.</p>
                    </div>
                    <div class="hidden md:block">
                        <i class="fa-solid fa-quote-left text-5xl text-orange-100"></i>
                    </div>
                </div>

                {{-- التنبيهات --}}
                @if (session('success'))
                    <div
                        class="mb-10 p-5 bg-green-50 border-r-4 border-green-500 text-green-700 rounded-2xl flex items-start gap-4 shadow-sm animate-bounce-short">
                        <i class="fa-solid fa-circle-check text-2xl mt-0.5"></i>
                        <div>
                            <p class="font-black text-lg">رائع! تم الإرسال</p>
                            <p class="text-sm opacity-90">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- الحقل: الاسم --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-slate-700 mr-2">الاسم الكامل</label>
                            <div class="relative group">
                                <input type="text" name="name" required value="{{ old('name') }}"
                                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 pl-12 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/5 transition duration-300 placeholder-gray-400 font-bold text-slate-800"
                                    placeholder="مثلاً: علي صالح">
                                <i
                                    class="fa-regular fa-user absolute left-5 top-5 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs font-bold mt-1 pr-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- الحقل: البريد --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-black text-slate-700 mr-2">البريد الإلكتروني</label>
                            <div class="relative group">
                                <input type="email" name="email" required value="{{ old('email') }}"
                                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 pl-12 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/5 transition duration-300 placeholder-gray-400 font-bold text-slate-800"
                                    placeholder="name@mail.com">
                                <i
                                    class="fa-regular fa-envelope absolute left-5 top-5 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs font-bold mt-1 pr-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- الحقل: الموضوع --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 mr-2">ما هو موضوع استفسارك؟</label>
                        <div class="relative group">
                            <select name="subject"
                                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 pr-12 focus:bg-white focus:outline-none focus:border-orange-500 transition duration-300 text-slate-700 font-bold appearance-none cursor-pointer">
                                <option>استفسار عام</option>
                                <option>مشكلة تقنية في الحساب</option>
                                <option>اعتراض على حجز</option>
                                <option>طلب شراكة أو تعاون</option>
                                <option>أخرى</option>
                            </select>
                            <i
                                class="fa-solid fa-chevron-down absolute left-5 top-5 text-gray-400 pointer-events-none group-focus-within:text-orange-500 transition-colors"></i>
                            <i
                                class="fa-solid fa-tags absolute right-5 top-5 text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
                        </div>
                    </div>

                    {{-- الحقل: الرسالة --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-black text-slate-700 mr-2">تفاصيل الرسالة</label>
                        <textarea name="message" rows="5" required
                            class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-5 py-4 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/5 transition duration-300 placeholder-gray-400 font-bold text-slate-800 resize-none"
                            placeholder="اكتب كل ما يدور في ذهنك هنا...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs font-bold mt-1 pr-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- زر الإرسال --}}
                    <div class="pt-6">
                        <button type="submit"
                            class="w-full bg-slate-900 text-white font-black py-5 rounded-2xl hover:bg-orange-600 transition-all duration-500 shadow-2xl shadow-slate-200 hover:shadow-orange-500/40 transform hover:-translate-y-2 flex items-center justify-center gap-3 group relative overflow-hidden">
                            {{-- تأثير ضوئي عند الحوام --}}
                            <span
                                class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></span>

                            <span class="relative">إرسال الرسالة للمراجعة</span>
                            <i
                                class="fa-solid fa-paper-plane relative group-hover:translate-x-2 group-hover:-translate-y-2 transition-transform duration-500"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
