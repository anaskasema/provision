@extends('layouts.app')

@section('title', 'من نحن - قصة RentHub')

@section('content')

    {{-- ========================================== --}}
    {{-- 1. الهيدر الإبداعي (صورة فقط بدون نص) --}}
    {{-- ========================================== --}}
    <div class="relative bg-slate-900 pb-24">
        {{-- خلفية جمالية --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-orange-500/20 blur-3xl"></div>
            <div class="absolute top-1/2 -left-24 w-72 h-72 rounded-full bg-blue-500/10 blur-3xl"></div>
        </div>

        {{-- حاوية الصورة --}}
        <div class="relative h-[350px] md:h-[400px] overflow-hidden">
            {{-- الصورة الأصلية كما طلبت (بدون نصوص فوقها) --}}
            <img src="{{ asset('images/about.png') }}"
                class="w-full h-full object-cover object-top hover:scale-105 transition duration-700" alt="RentHub Team">

            {{-- قناع متدرج في الأسفل لدمج الصورة مع الخلفية --}}
            <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-slate-900 to-transparent"></div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 2. قسم الإحصائيات العائم (Floating Stats) --}}
    {{-- ========================================== --}}
    <div class="container mx-auto px-4 relative z-20 -mt-20 mb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- البطاقة 1 --}}
            <div
                class="bg-white rounded-2xl p-6 shadow-xl shadow-slate-900/10 border-b-4 border-orange-500 transform hover:-translate-y-2 transition duration-300">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-4xl font-black text-slate-800">+{{ \App\Models\Item::count() }}</h3>
                    <div class="w-10 h-10 bg-orange-50 rounded-full flex items-center justify-center text-orange-600">
                        <i class="fa-solid fa-box-open text-lg"></i>
                    </div>
                </div>
                <p class="text-gray-500 font-bold text-sm">معدة جاهزة للإيجار</p>
            </div>

            {{-- البطاقة 2 --}}
            <div
                class="bg-slate-800 rounded-2xl p-6 shadow-xl shadow-slate-900/20 border-b-4 border-blue-500 transform hover:-translate-y-2 transition duration-300">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-4xl font-black text-white">+{{ \App\Models\User::count() }}</h3>
                    <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center text-white">
                        <i class="fa-solid fa-users text-lg"></i>
                    </div>
                </div>
                <p class="text-slate-400 font-bold text-sm">عميل يثق بنا</p>
            </div>

            {{-- البطاقة 3 --}}
            <div
                class="bg-white rounded-2xl p-6 shadow-xl shadow-slate-900/10 border-b-4 border-green-500 transform hover:-translate-y-2 transition duration-300">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-4xl font-black text-slate-800">100%</h3>
                    <div class="w-10 h-10 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                        <i class="fa-solid fa-shield-check text-lg"></i>
                    </div>
                </div>
                <p class="text-gray-500 font-bold text-sm">حماية وضمان</p>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 3. قسم القصة والمحتوى (Design Grid) --}}
    {{-- ========================================== --}}
    <div class="container mx-auto px-4 mb-24">
        <div class="flex flex-col lg:flex-row items-center gap-16">

            {{-- النص --}}
            <div class="w-full lg:w-1/2">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-bold mb-6">
                    <span class="w-2 h-2 rounded-full bg-orange-600 animate-pulse"></span>
                    قصتنا ورؤيتنا
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight mb-6">
                    نغير مفهوم <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-orange-400">امتلاك
                        المعدات</span> للأبد.
                </h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    لماذا تشتري معدة باهظة الثمن لتستخدمها مرة واحدة؟ في <strong>RentHub</strong>، قمنا ببناء جسر يربط بين
                    أصحاب المعدات والباحثين عنها.
                </p>
                <p class="text-gray-500 mb-8 leading-relaxed">
                    نحن لا نوفر منصة تأجير فحسب، بل نبني مجتمعاً يعتمد على الاقتصاد التشاركي، حيث يتحول "الراكد" إلى "دخل"،
                    وتتحول "الحاجة" إلى "سهولة".
                </p>

                {{-- قائمة مميزات صغيرة --}}
                <ul class="space-y-4">
                    <li class="flex items-center gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-check"></i></div>
                        <span class="text-slate-700 font-bold">توثيق الهوية لجميع الأطراف</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-check"></i></div>
                        <span class="text-slate-700 font-bold">عقود إلكترونية تحفظ الحقوق</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div
                            class="w-6 h-6 rounded-full bg-green-100 text-green-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-check"></i></div>
                        <span class="text-slate-700 font-bold">دعم فني متواجد دائماً</span>
                    </li>
                </ul>
            </div>

            {{-- الصورة المركبة --}}
            <div class="w-full lg:w-1/2 relative">
                <div
                    class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white transform rotate-2 hover:rotate-0 transition duration-500">
                    <img src="{{ asset('images/about3.png') }}" class="w-full object-cover" alt="فريقنا">
                </div>
                {{-- عنصر زخرفي خلف الصورة --}}
                <div class="absolute top-10 -left-10 w-full h-full bg-slate-100 rounded-[3rem] -z-10 transform -rotate-2">
                </div>
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-orange-500/10 rounded-full blur-2xl"></div>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 4. قيمنا (Cards Grid) --}}
    {{-- ========================================== --}}
    <div class="bg-gray-50 py-24 relative overflow-hidden">
        {{-- أيقونة خلفية كبيرة --}}
        <i class="fa-solid fa-quote-right absolute top-10 right-10 text-9xl text-slate-200/50 -z-0"></i>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">ما الذي يميزنا؟</h2>
                <p class="text-gray-500">نحن لا نقدم خدمة فقط، بل نقدم تجربة مبنية على الثقة والاحترافية.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- بطاقة 1 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition duration-300 group">
                    <div
                        class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 text-2xl mb-6 group-hover:scale-110 transition duration-300">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">الشفافية المطلقة</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">لا رسوم مخفية، لا شروط غامضة. كل شيء واضح من اللحظة
                        الأولى بين المؤجر والمستأجر.</p>
                </div>

                {{-- بطاقة 2 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition duration-300 group">
                    <div
                        class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 text-2xl mb-6 group-hover:scale-110 transition duration-300">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">السرعة والسهولة</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">واجهة مستخدم صممت لتنقلك من "البحث" إلى "الاستلام" في
                        دقائق معدودة فقط.</p>
                </div>

                {{-- بطاقة 3 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition duration-300 group">
                    <div
                        class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 text-2xl mb-6 group-hover:scale-110 transition duration-300">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">دعم محلي 100%</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">فريقنا متواجد في اليمن، يفهم احتياجاتك ويتحدث لغتك لحل
                        أي مشكلة تواجهك.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 5. الدعوة للانضمام (Modern CTA) --}}
    {{-- ========================================== --}}
    <div class="py-20 container mx-auto px-4">
        <div class="bg-slate-900 rounded-[3rem] p-10 md:p-16 text-center relative overflow-hidden shadow-2xl">
            {{-- زخارف --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-orange-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl"></div>

            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-5xl font-black text-white mb-6">كن جزءاً من النجاح</h2>
                <p class="text-slate-300 text-lg mb-10">
                    سواء كنت تملك معدات تريد استثمارها، أو تبحث عن أدوات لإنجاز عملك، <br> RentHub هو مكانك الصحيح.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}"
                        class="bg-orange-600 text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-orange-700 transition shadow-lg shadow-orange-600/30 transform hover:-translate-y-1">
                        ابدأ الآن مجاناً
                    </a>
                    <a href="{{ route('items.index') }}"
                        class="bg-white/10 backdrop-blur-md text-white border border-white/20 px-10 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-slate-900 transition">
                        تصفح السوق
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
