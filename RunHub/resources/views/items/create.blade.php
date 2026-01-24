@extends('layouts.app')

@section('title', 'إضافة معدة جديدة')

@section('content')

    {{-- الهيدر الكحلي --}}
    <div class="relative bg-slate-900 py-20 pb-32 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">إضافة معدة جديدة</h1>
                <p class="text-slate-400">أدخل تفاصيل المعدة بدقة لزيادة فرص التأجير</p>
            </div>
        </div>
    </div>

    {{-- محتوى النموذج --}}
    <div class="container mx-auto px-4 -mt-20 relative z-20 pb-20 max-w-5xl">

        {{-- تم إزالة كود عرض الرسائل القديم من هنا لأنه أصبح يظهر تلقائياً عبر Layout --}}

        {{-- عرض أخطاء الـ Validation فقط هنا لأنها خاصة بالفورم --}}
        @if ($errors->any())
            <div
                class="bg-red-50 border-r-4 border-red-500 text-red-700 p-5 mb-8 rounded-xl shadow-lg flex items-start gap-3 animate-fade-in-up">
                <i class="fa-solid fa-triangle-exclamation mt-1"></i>
                <div>
                    <p class="font-bold">يرجى تصحيح الأخطاء التالية:</p>
                    <ul class="list-disc list-inside text-sm mt-1 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8"
            id="createItemForm">
            @csrf

            {{-- البطاقة الأولى: التفاصيل الأساسية --}}
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                <h2 class="text-xl font-bold text-slate-900 mb-8 flex items-center gap-3 border-b border-gray-100 pb-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-lg border border-orange-100">
                        <i class="fa-solid fa-info"></i>
                    </div>
                    تفاصيل المعدة
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="md:col-span-2 group">
                        <label
                            class="block text-slate-700 font-bold mb-2 text-sm group-focus-within:text-orange-600 transition">اسم
                            المعدة <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition duration-300 placeholder-gray-400 font-medium"
                            placeholder="مثلاً: حفار كتربلر 320">
                    </div>

                    <div class="group">
                        <label
                            class="block text-slate-700 font-bold mb-2 text-sm group-focus-within:text-orange-600 transition">الفئة
                            <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="category_id" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition duration-300 appearance-none cursor-pointer font-medium text-slate-700">
                                <option value="" disabled selected>اختر الفئة</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div class="group">
                        <label
                            class="block text-slate-700 font-bold mb-2 text-sm group-focus-within:text-orange-600 transition">المدينة
                            <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="city" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition duration-300 appearance-none cursor-pointer font-medium text-slate-700">
                                <option value="" disabled selected>اختر المدينة</option>
                                <option value="صنعاء" {{ old('city') == 'صنعاء' ? 'selected' : '' }}>صنعاء</option>
                                <option value="عدن" {{ old('city') == 'عدن' ? 'selected' : '' }}>عدن</option>
                                <option value="تعز" {{ old('city') == 'تعز' ? 'selected' : '' }}>تعز</option>
                                <option value="حضرموت" {{ old('city') == 'حضرموت' ? 'selected' : '' }}>حضرموت</option>
                                <option value="إب" {{ old('city') == 'إب' ? 'selected' : '' }}>إب</option>
                            </select>
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6 group">
                    <label
                        class="block text-slate-700 font-bold mb-2 text-sm group-focus-within:text-orange-600 transition">الوصف
                        التفصيلي <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required
                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition duration-300 placeholder-gray-400 font-medium resize-none"
                        placeholder="اكتب وصفاً دقيقاً للمعدة، حالتها، وسنة الصنع...">{{ old('description') }}</textarea>
                </div>

                <div class="group">
                    <label
                        class="block text-slate-700 font-bold mb-2 text-sm group-focus-within:text-orange-600 transition">سعر
                        الإيجار اليومي <span class="text-red-500">*</span></label>
                    <div class="relative max-w-xs">
                        <input type="number" name="price_per_day" value="{{ old('price_per_day') }}" required
                            min="0" step="0.01"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-4 pl-20 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition duration-300 font-bold text-lg text-slate-800"
                            placeholder="0.00">
                        <span
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 text-orange-600 font-bold text-sm bg-orange-100 border border-orange-200 px-2 py-1 rounded-lg">YER</span>
                    </div>
                </div>
            </div>

            {{-- البطاقة الثانية: المواصفات --}}
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
                    <h2 class="text-xl font-bold text-slate-900 flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-lg border border-orange-100">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        المواصفات الفنية
                    </h2>
                    <button type="button" onclick="addSpec()"
                        class="text-sm bg-slate-50 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-900 hover:text-white transition font-bold border border-slate-200 hover:border-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> إضافة خاصية
                    </button>
                </div>

                <div id="specs-container" class="space-y-4">
                    {{-- حقل افتراضي --}}
                    <div class="flex gap-4 items-center">
                        <input type="text" name="spec_keys[]" placeholder="الخاصية (مثلاً: اللون)"
                            class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
                        <input type="text" name="spec_values[]" placeholder="القيمة (مثلاً: أصفر)"
                            class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
                    </div>
                </div>
                <p class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                    <i class="fa-solid fa-circle-info"></i>
                    أضف تفاصيل إضافية مثل: الموديل، سنة الصنع، الحالة، نوع الوقود.
                </p>
            </div>

            {{-- البطاقة الثالثة: الصور (مع المعاينة المباشرة) --}}
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                <h2 class="text-xl font-bold text-slate-900 mb-8 flex items-center gap-3 border-b border-gray-100 pb-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-lg border border-orange-100">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    صور المعدة
                </h2>

                <div
                    class="border-2 border-dashed border-gray-300 rounded-2xl p-10 text-center hover:bg-orange-50 hover:border-orange-400 transition cursor-pointer relative group duration-300">
                    <input type="file" name="images[]" multiple accept="image/png, image/jpeg, image/jpg"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                        onchange="previewImages(this)">
                    <div class="text-gray-500 group-hover:text-orange-600 transition duration-300">
                        <div
                            class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-white group-hover:shadow-md transition duration-300">
                            <i class="fa-solid fa-cloud-arrow-up text-3xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <p class="font-bold text-lg">اضغط لاختيار الصور أو اسحبها هنا</p>
                        <p class="text-sm mt-2 text-gray-400 group-hover:text-orange-400">يدعم PNG, JPG (الحد الأقصى 5 صور)
                        </p>
                    </div>
                </div>

                {{-- منطقة المعاينة --}}
                <div id="image-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6"></div>
            </div>

            {{-- أزرار التحكم --}}
            <div class="flex justify-end gap-4 pb-10 pt-4">
                <button type="button" onclick="history.back()"
                    class="px-8 py-4 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-100 transition duration-300 cursor-pointer">
                    إلغاء
                </button>

                <button type="submit"
                    class="px-10 py-4 rounded-xl bg-slate-900 text-white font-bold hover:bg-slate-800 shadow-xl hover:shadow-slate-900/30 transition transform active:scale-95 flex items-center gap-3 duration-300">
                    <i class="fa-solid fa-check"></i> حفظ ونشر المعدة
                </button>
            </div>
        </form>
    </div>

    <script>
        // إضافة مواصفات جديدة
        function addSpec() {
            const container = document.getElementById('specs-container');
            const div = document.createElement('div');
            div.className = 'flex gap-4 items-center animate-fade-in mt-3';
            div.innerHTML = `
            <input type="text" name="spec_keys[]" placeholder="الخاصية" class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
            <input type="text" name="spec_values[]" placeholder="القيمة" class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:bg-white focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 w-10 h-10 flex items-center justify-center rounded-xl hover:bg-red-50 transition border border-transparent hover:border-red-100"><i class="fa-solid fa-trash"></i></button>
        `;
            container.appendChild(div);
        }

        // معاينة الصور
        function previewImages(input) {
            const container = document.getElementById('image-preview');
            container.innerHTML = ''; // مسح الصور السابقة لعدم التكرار عند إعادة الاختيار

            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative group animate-fade-in-up';
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-32 object-cover rounded-xl border border-gray-200 shadow-sm group-hover:border-orange-300 transition">
                            <div class="absolute top-2 right-2 bg-black/50 text-white text-xs px-2 py-1 rounded-md opacity-0 group-hover:opacity-100 transition">${file.name}</div>
                        `;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
@endsection
