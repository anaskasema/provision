@extends('layouts.app')

@section('title', 'الشروط والأحكام')

@section('content')

    {{-- الهيدر الرسمي --}}
    <div class="bg-slate-900 py-16 border-b-4 border-orange-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl font-black text-white mb-3">الشروط والأحكام</h1>
            <p class="text-slate-400 text-sm font-medium tracking-wide">آخر تحديث: {{ date('Y/m/d') }}</p>
        </div>
    </div>

    {{-- جسم الصفحة --}}
    <div class="bg-gray-50 py-16 min-h-screen">
        <div class="container mx-auto px-4 max-w-5xl">

            {{-- كرت المحتوى --}}
            <div class="bg-white rounded-3xl shadow-xl border border-gray-200 overflow-hidden">

                {{-- تنبيه هام في البداية --}}
                <div class="bg-orange-50 border-b border-orange-100 p-6 md:p-8 flex gap-5 items-start">
                    <div
                        class="w-12 h-12 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shrink-0 text-xl">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-lg mb-1">اتفاقية استخدام ملزمة</h4>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            مرحباً بك في RentHub. تسجيلك واستخدامك للمنصة يعني موافقتك الكاملة على هذه الشروط. تهدف هذه
                            البنود لحماية حقوق المؤجر والمستأجر وضمان تجربة آمنة للجميع.
                        </p>
                    </div>
                </div>

                <div class="p-8 md:p-12 space-y-12">

                    {{-- البند 1: شروط التسجيل والهوية --}}
                    <section class="relative">
                        <div class="flex items-center gap-4 mb-4">
                            <span
                                class="text-4xl font-black text-slate-200 absolute -right-4 -top-4 select-none opacity-50">01</span>
                            <h3 class="text-xl font-bold text-slate-900 relative z-10 flex items-center gap-2">
                                <i class="fa-solid fa-id-card text-orange-500"></i> الهوية والتحقق
                            </h3>
                        </div>
                        <div class="pr-6 border-r-2 border-slate-100 space-y-3 text-gray-600 leading-7">
                            <p>لضمان الجدية والأمان، يلتزم جميع المستخدمين (مؤجرين ومستأجرين) بالآتي:</p>
                            <ul class="list-disc list-inside space-y-2 text-sm marker:text-orange-500">
                                <li>تقديم بيانات حقيقية (الاسم الكامل، رقم الهاتف).</li>
                                <li><strong>تسليم إثبات الهوية (الأصل):</strong> يلتزم المستأجر بتسليم بطاقته الشخصية (أو
                                    جواز السفر) للمؤجر كضمان عند استلام المعدة، ويستردها فور إرجاع المعدة سليمة.</li>
                                <li>المنصة لا تحتفظ بنسخ الهوية، بل يتم التحقق منها بين الطرفين مباشرة.</li>
                            </ul>
                        </div>
                    </section>

                    {{-- البند 2: آلية الحجز والتواصل --}}
                    <section class="relative">
                        <div class="flex items-center gap-4 mb-4">
                            <span
                                class="text-4xl font-black text-slate-200 absolute -right-4 -top-4 select-none opacity-50">02</span>
                            <h3 class="text-xl font-bold text-slate-900 relative z-10 flex items-center gap-2">
                                <i class="fa-solid fa-handshake text-orange-500"></i> الحجز والتواصل
                            </h3>
                        </div>
                        <div class="pr-6 border-r-2 border-slate-100 text-gray-600 leading-7">
                            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 mb-4">
                                <p class="text-sm text-blue-800 font-bold">
                                    <i class="fa-solid fa-circle-info ml-1"></i> سياسة الخصوصية في التواصل:
                                </p>
                                <p class="text-xs text-blue-700 mt-1">
                                    لا يتم إظهار رقم الهاتف للطرف الآخر إلا <strong>بعد إرسال طلب الحجز</strong>. هذا
                                    الإجراء يضمن الجدية ويمنع الإزعاج.
                                </p>
                            </div>
                            <p class="text-sm">يتم اعتماد الحجز نهائياً بعد موافقة "المؤجر" على الطلب والتواصل مع المستأجر
                                لتحديد مكان وزمان التسليم.</p>
                        </div>
                    </section>

                    {{-- البند 3: الدفع والرسوم --}}
                    <section class="relative">
                        <div class="flex items-center gap-4 mb-4">
                            <span
                                class="text-4xl font-black text-slate-200 absolute -right-4 -top-4 select-none opacity-50">03</span>
                            <h3 class="text-xl font-bold text-slate-900 relative z-10 flex items-center gap-2">
                                <i class="fa-solid fa-money-bill-wave text-orange-500"></i> الدفع والرسوم
                            </h3>
                        </div>
                        <div class="pr-6 border-r-2 border-slate-100 text-gray-600 leading-7 text-sm">
                            <p class="mb-2">نظراً لطبيعة السوق الحالية، يتم التعامل المالي وفق الآتي:</p>
                            <ul class="list-disc list-inside space-y-2 marker:text-orange-500">
                                <li><strong>الدفع المباشر:</strong> يتم دفع قيمة الإيجار المتفق عليها (كاش أو تحويل بنكي)
                                    للمؤجر مباشرة عند استلام المعدة.</li>
                                <li><strong>العربون:</strong> يحق للمؤجر طلب عربون لضمان الحجز في فترات الذروة.</li>
                                <li>الأسعار المعروضة في الموقع هي أسعار تقديرية لليوم الواحد، ويتم احتساب الإجمالي بناءً على
                                    عدد الأيام.</li>
                            </ul>
                        </div>
                    </section>

                    {{-- البند 4: سياسة الإلغاء (بتصميم الكروت) --}}
                    <section class="relative">
                        <div class="flex items-center gap-4 mb-6">
                            <span
                                class="text-4xl font-black text-slate-200 absolute -right-4 -top-4 select-none opacity-50">04</span>
                            <h3 class="text-xl font-bold text-slate-900 relative z-10 flex items-center gap-2">
                                <i class="fa-solid fa-clock-rotate-left text-orange-500"></i> سياسة الإلغاء
                            </h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pr-6">
                            {{-- كرت الإلغاء المجاني --}}
                            <div
                                class="group border border-green-200 bg-green-50/50 p-6 rounded-2xl hover:bg-green-50 transition duration-300">
                                <div
                                    class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-3 group-hover:scale-110 transition">
                                    <i class="fa-regular fa-thumbs-up"></i>
                                </div>
                                <h5 class="font-bold text-slate-900 mb-2">إلغاء مجاني ومبكر</h5>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    يمكنك إلغاء الحجز دون أي تبعات أو رسوم إذا تم الإلغاء قبل موعد الاستلام بـ <strong>24
                                        ساعة</strong> على الأقل.
                                </p>
                            </div>

                            {{-- كرت الإلغاء المتأخر --}}
                            <div
                                class="group border border-red-200 bg-red-50/50 p-6 rounded-2xl hover:bg-red-50 transition duration-300">
                                <div
                                    class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-3 group-hover:scale-110 transition">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <h5 class="font-bold text-slate-900 mb-2">إلغاء متأخر</h5>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    الإلغاء قبل أقل من 24 ساعة قد يعرض حسابك لتقييم سلبي، أو وضعه في القائمة السوداء
                                    للمزودين.
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- البند 5: المسؤولية --}}
                    <section class="relative">
                        <div class="flex items-center gap-4 mb-4">
                            <span
                                class="text-4xl font-black text-slate-200 absolute -right-4 -top-4 select-none opacity-50">05</span>
                            <h3 class="text-xl font-bold text-slate-900 relative z-10 flex items-center gap-2">
                                <i class="fa-solid fa-gavel text-orange-500"></i> إخلاء المسؤولية
                            </h3>
                        </div>
                        <div class="pr-6 border-r-2 border-slate-100 text-gray-600 leading-7 text-sm">
                            <p>
                                منصة <strong>RentHub</strong> هي وسيط تقني يربط الطرفين. نحن لا نملك المعدات ولا نضمن جودتها
                                بشكل مباشر (رغم سعينا للتحقق). يتحمل المستأجر المسؤولية الكاملة عن فحص المعدة عند الاستلام،
                                وعن أي تلف يحدث لها أثناء فترة حيازته لها.
                            </p>
                        </div>
                    </section>

                </div>

                {{-- الفوتر --}}
                <div class="bg-gray-50 border-t border-gray-200 p-8 text-center">
                    <p class="text-gray-500 text-sm mb-4">باستمرارك في استخدام الموقع، أنت تقر بأنك قرأت وفهمت هذه الشروط.
                    </p>
                    <a href="{{ route('items.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-orange-600 transition shadow-lg">
                        <i class="fa-solid fa-check"></i> موافق، تصفح المعدات
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
