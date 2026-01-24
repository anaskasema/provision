@extends('layouts.app')

@section('title', 'فريق الإبداع - شرعب سوفت وير')

@section('content')

    {{-- ========================================================= --}}
    {{-- 1. الهيدر: نص عالمي وقوي --}}
    {{-- ========================================================= --}}
    <div class="relative bg-slate-900 py-24 pb-32 overflow-hidden rounded-b-[4rem] shadow-2xl mb-24">
        {{-- الخلفية --}}
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20">
        </div>
        <div class="absolute top-0 right-0 w-full h-full bg-gradient-to-b from-transparent to-slate-900/90 z-0"></div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <div
                class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-orange-500/10 border border-orange-500/20 text-orange-500 text-xs font-bold tracking-widest uppercase mb-8 backdrop-blur-md shadow-lg shadow-orange-500/10">
                <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-pulse"></span>
                Sharab Software Team
            </div>

            <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight">
                نبتكر الحلول الرقمية <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-200">التي تقود
                    المستقبل</span>
            </h1>

            <p class="text-slate-400 max-w-4xl mx-auto text-lg md:text-xl leading-relaxed font-light">
                في "شرعب سوفت وير"، لا نكتب مجرد أسطر برمجية؛ نحن نصوغ تجارب رقمية متكاملة تلامس الاحتياج وتصنع الفرق. نحن
                العقول الشغوفة والأنامل المبدعة التي تقف خلف نجاح منصة <strong
                    class="text-white border-b-2 border-orange-500">RentHub</strong>.
            </p>
        </div>
    </div>

    {{-- ========================================================= --}}
    {{-- 2. بطاقات الفريق --}}
    {{-- ========================================================= --}}
    <div class="container mx-auto px-6 -mt-32 relative z-20 pb-24">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-24 gap-x-8">

            {{-- 1. غالب المخلافي --}}
            <div
                class="group bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-visible hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-300 hover:-translate-y-2 mt-12">
                <div class="h-40 bg-slate-900 rounded-t-[2.5rem] relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20">
                    </div>

                    {{-- الصورة --}}
                    <div
                        class="absolute -bottom-20 right-1/2 translate-x-1/2 w-44 h-44 p-1.5 bg-white rounded-full shadow-lg">
                        {{-- تم استخدام asset وضبط object-cover --}}
                        <img src="{{ asset('images/ghaleb.jpg') }}"
                            class="w-full h-full rounded-full object-cover object-top border-4 border-slate-50 shadow-inner"
                            alt="غالب المخلافي"
                            onerror="this.src='https://ui-avatars.com/api/?name=Ghaleb+Almikhlafi&background=0f172a&color=fff&size=512&bold=true'">
                        {{-- صورة بديلة في حال عدم وجود الصورة --}}
                    </div>
                </div>
                <div class="pt-24 pb-8 px-6 text-center">
                    <h3 class="text-2xl font-black text-slate-900 mb-2">غالب المخلافي</h3>
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-orange-50 text-orange-600 text-[11px] font-extrabold border border-orange-100 mb-6 tracking-wide uppercase">
                        Team Leader & Full Stack
                    </span>
                    <p class="text-gray-500 text-sm leading-loose mb-8 border-t border-gray-50 pt-6">
                        المايسترو الذي يربط الرؤية بالواقع. يمتلك خبرة عميقة في هندسة النظم المعقدة، ويضمن أن يكون أساس
                        المشروع متيناً وقابلاً للتوسع المستقبلي.
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-facebook-f text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-whatsapp text-xl"></i></a>
                    </div>
                </div>
            </div>

            {{-- 2. بشار العمراني --}}
            <div
                class="group bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-visible hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-300 hover:-translate-y-2 mt-12">
                <div class="h-40 bg-slate-900 rounded-t-[2.5rem] relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20">
                    </div>
                    <div
                        class="absolute -bottom-20 right-1/2 translate-x-1/2 w-44 h-44 p-1.5 bg-white rounded-full shadow-lg">
                        <img src="{{ asset('images/bashar.jpg') }}"
                            class="w-full h-full rounded-full object-cover object-top border-4 border-slate-50 shadow-inner"
                            alt="بشار العمراني"
                            onerror="this.src='https://ui-avatars.com/api/?name=Bashar+Alamrani&background=1e293b&color=fff&size=512&bold=true'">
                    </div>
                </div>
                <div class="pt-24 pb-8 px-6 text-center">
                    <h3 class="text-2xl font-black text-slate-900 mb-2">بشار العمراني</h3>
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-blue-50 text-blue-600 text-[11px] font-extrabold border border-blue-100 mb-6 tracking-wide uppercase">
                        Backend Developer
                    </span>
                    <p class="text-gray-500 text-sm leading-loose mb-8 border-t border-gray-50 pt-6">
                        العقل المنطقي للفريق. يتولى مسؤولية "المحرك" الخفي للموقع، متميز في بناء واجهات برمجية (APIs) سريعة،
                        والتعامل مع قواعد البيانات الضخمة بكفاءة عالية.
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-facebook-f text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-whatsapp text-xl"></i></a>
                    </div>
                </div>
            </div>

            {{-- 3. محمد اليوسفي --}}
            <div
                class="group bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-visible hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-300 hover:-translate-y-2 mt-12">
                <div class="h-40 bg-slate-900 rounded-t-[2.5rem] relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20">
                    </div>
                    <div
                        class="absolute -bottom-20 right-1/2 translate-x-1/2 w-44 h-44 p-1.5 bg-white rounded-full shadow-lg">
                        <img src="{{ asset('images/mohammed.jpg') }}"
                            class="w-full h-full rounded-full object-cover object-top border-4 border-slate-50 shadow-inner"
                            alt="محمد اليوسفي"
                            onerror="this.src='https://ui-avatars.com/api/?name=Mohammed+Alyousifi&background=f97316&color=fff&size=512&bold=true'">
                    </div>
                </div>
                <div class="pt-24 pb-8 px-6 text-center">
                    <h3 class="text-2xl font-black text-slate-900 mb-2">محمد اليوسفي</h3>
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-pink-50 text-pink-600 text-[11px] font-extrabold border border-pink-100 mb-6 tracking-wide uppercase">
                        Frontend & UI/UX
                    </span>
                    <p class="text-gray-500 text-sm leading-loose mb-8 border-t border-gray-50 pt-6">
                        حلقة الوصل بين الإنسان والآلة. يمتلك لمسة فنية فريدة تجعل تصفح الموقع رحلة بصرية ممتعة، مع التركيز
                        الشديد على سهولة الاستخدام وتجاوب التصميم.
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-facebook-f text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-whatsapp text-xl"></i></a>
                    </div>
                </div>
            </div>

            {{-- 4. أكرم الشرعبي --}}
            <div
                class="group bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-visible hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-300 hover:-translate-y-2 mt-12 lg:col-start-1 lg:ml-auto">
                <div class="h-40 bg-slate-900 rounded-t-[2.5rem] relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20">
                    </div>
                    <div
                        class="absolute -bottom-20 right-1/2 translate-x-1/2 w-44 h-44 p-1.5 bg-white rounded-full shadow-lg">
                        <img src="{{ asset('images/akrm.jpg') }}"
                            class="w-full h-full rounded-full object-cover object-top border-4 border-slate-50 shadow-inner"
                            alt="أكرم الشرعبي"
                            onerror="this.src='https://ui-avatars.com/api/?name=Akram+Alsharabi&background=059669&color=fff&size=512&bold=true'">
                    </div>
                </div>
                <div class="pt-24 pb-8 px-6 text-center">
                    <h3 class="text-2xl font-black text-slate-900 mb-2">أكرم الشرعبي</h3>
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-extrabold border border-emerald-100 mb-6 tracking-wide uppercase">
                        Security & DevOps
                    </span>
                    <p class="text-gray-500 text-sm leading-loose mb-8 border-t border-gray-50 pt-6">
                        الدرع الحصين للمشروع. يركز على حماية بيانات المستخدمين، سد الثغرات الأمنية، وضمان عمل الخوادم بكفاءة
                        قصوى دون انقطاع.
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-facebook-f text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-whatsapp text-xl"></i></a>
                    </div>
                </div>
            </div>

            {{-- 5. أنس الشرعبي --}}
            <div
                class="group bg-white rounded-[2.5rem] shadow-xl border border-gray-100 overflow-visible hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-300 hover:-translate-y-2 mt-12 lg:col-start-2 lg:mr-auto">
                <div class="h-40 bg-slate-900 rounded-t-[2.5rem] relative overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20">
                    </div>
                    <div
                        class="absolute -bottom-20 right-1/2 translate-x-1/2 w-44 h-44 p-1.5 bg-white rounded-full shadow-lg">
                        <img src="{{ asset('images/Anas.jpg') }}"
                            class="w-full h-full rounded-full object-cover object-top border-4 border-slate-50 shadow-inner"
                            alt="أنس الشرعبي"
                            onerror="this.src='https://ui-avatars.com/api/?name=Anas+Alsharabi&background=7c3aed&color=fff&size=512&bold=true'">
                    </div>
                </div>
                <div class="pt-24 pb-8 px-6 text-center">
                    <h3 class="text-2xl font-black text-slate-900 mb-2">أنس الشرعبي</h3>
                    <span
                        class="inline-block px-4 py-1.5 rounded-full bg-purple-50 text-purple-600 text-[11px] font-extrabold border border-purple-100 mb-6 tracking-wide uppercase">
                        Project Manager & QA
                    </span>
                    <p class="text-gray-500 text-sm leading-loose mb-8 border-t border-gray-50 pt-6">
                        ضابط الإيقاع ومسؤول الجودة. يقوم بالتخطيط الدقيق للمراحل، واختبار النظام (QA) لضمان خروج المنتج
                        خالياً من الأخطاء ومطابقاً لأعلى المعايير.
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-facebook-f text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#"
                            class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md"><i
                                class="fa-brands fa-whatsapp text-xl"></i></a>
                    </div>
                </div>
            </div>

        </div>

        {{-- زر التواصل --}}
        <div class="mt-20 text-center">
            <p class="text-slate-500 mb-6 font-medium">هل أعجبك عملنا؟ نحن جاهزون للمشروع القادم.</p>
            <a href="https://wa.me/96771644308" target="_blank"
                class="inline-flex items-center gap-3 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-orange-600 transition-all duration-300 shadow-xl hover:shadow-orange-500/30 group">
                <span>تواصل مع الفريق</span>
                <i class="fa-brands fa-whatsapp text-xl group-hover:scale-110 transition-transform"></i>
            </a>
        </div>

    </div>

@endsection
