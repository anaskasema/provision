@extends('layouts.app')

@section('title', 'سياسة الخصوصية')

@section('content')

    {{-- الهيدر: بسيط ورسمي --}}
    <div class="bg-slate-900 py-16 border-b-4 border-orange-600">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-black text-white mb-2">سياسة الخصوصية</h1>
            <p class="text-slate-400 text-sm font-medium">آخر تحديث: {{ date('Y/m/d') }}</p>
        </div>
    </div>

    {{-- جسم الصفحة --}}
    <div class="bg-gray-50 py-12 min-h-screen">
        <div class="container mx-auto px-4 max-w-4xl">

            {{-- الورقة الرئيسية (تصميم مستند) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                {{-- مقدمة --}}
                <div class="p-8 md:p-10 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex items-start gap-4">
                        <i class="fa-solid fa-scale-balanced text-4xl text-slate-800 mt-1"></i>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900 mb-2">مقدمة عامة</h2>
                            <p class="text-gray-600 leading-relaxed text-sm">
                                مرحباً بك في RentHub. نحن ندرك أهمية الخصوصية بالنسبة لك، ونلتزم بحماية بياناتك الشخصية
                                واستخدامها فقط بالطرق التي تتوقعها منا. توضح هذه السياسة كيفية جمعنا واستخدامنا لبياناتك.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- المحتوى --}}
                <div class="p-8 md:p-10 space-y-10">

                    {{-- البند الأول --}}
                    <div class="flex gap-4 md:gap-6">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-sm">
                            1</div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 mb-3 border-b border-gray-100 pb-2 inline-block">
                                البيانات التي نجمعها</h3>
                            <p class="text-gray-600 text-sm leading-7">
                                لتقديم خدماتنا، نحتاج لجمع بعض المعلومات الأساسية:
                            </p>
                            <ul class="mt-3 space-y-2 text-sm text-gray-600 list-disc list-inside marker:text-orange-500">
                                <li><strong>معلومات الهوية:</strong> الاسم الكامل، ورقم الهوية (للتحقق الأمني).</li>
                                <li><strong>معلومات الاتصال:</strong> رقم الهاتف والبريد الإلكتروني.</li>
                                <li><strong>البيانات التقنية:</strong> مثل عنوان IP ونوع الجهاز لتحسين الأداء.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- البند الثاني --}}
                    <div class="flex gap-4 md:gap-6">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-sm">
                            2</div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 mb-3 border-b border-gray-100 pb-2 inline-block">
                                مشاركة بيانات الاتصال</h3>
                            <div class="bg-orange-50 border-r-4 border-orange-500 p-4 rounded-l-lg">
                                <p class="text-gray-700 text-sm leading-relaxed font-medium">
                                    <i class="fa-solid fa-circle-exclamation text-orange-600 ml-1"></i>
                                    نحن نحرص على خصوصيتك. لا يتم مشاركة <strong>رقم هاتفك</strong> مع الطرف الآخر (المؤجر أو
                                    المستأجر) إلا بعد <strong>إرسال طلب الحجز رسمياً</strong>. هذا الإجراء ضروري لتمكين
                                    التواصل والتنسيق لاستلام المعدة.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- البند الثالث --}}
                    <div class="flex gap-4 md:gap-6">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-sm">
                            3</div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 mb-3 border-b border-gray-100 pb-2 inline-block">
                                الأمان والحماية</h3>
                            <p class="text-gray-600 text-sm leading-7">
                                نستخدم أحدث تقنيات التشفير (Encryption) لحماية بياناتك المخزنة لدينا. صور الهوية الشخصية يتم
                                حفظها في خوادم مؤمنة ولا يمكن الوصول إليها إلا من قبل الموظفين المصرح لهم ولأغراض التحقق
                                فقط.
                            </p>
                        </div>
                    </div>

                    {{-- البند الرابع --}}
                    <div class="flex gap-4 md:gap-6">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-sm">
                            4</div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-slate-900 mb-3 border-b border-gray-100 pb-2 inline-block">
                                حقوق المستخدم</h3>
                            <p class="text-gray-600 text-sm leading-7">
                                يحق لك في أي وقت طلب تعديل بياناتك أو حذف حسابك نهائياً من سجلاتنا، بشرط عدم وجود معاملات
                                مالية أو حجوزات نشطة معلقة.
                            </p>
                        </div>
                    </div>

                </div>

                {{-- الفوتر الخاص بالمستند --}}
                <div class="bg-gray-50 border-t border-gray-200 p-6 text-center">
                    <p class="text-gray-500 text-xs mb-4">إذا كان لديك أي استفسار حول سياسة الخصوصية، يرجى التواصل معنا.</p>
                    <a href="{{ route('pages.contact') }}"
                        class="inline-flex items-center gap-2 text-slate-900 font-bold hover:text-orange-600 transition text-sm">
                        <i class="fa-solid fa-envelope"></i> تواصل مع الدعم القانوني
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
