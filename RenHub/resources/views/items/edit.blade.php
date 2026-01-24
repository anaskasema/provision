@extends('layouts.app')

@section('title', 'تعديل المعدة - ' . $item->title)

@section('content')

    {{-- الهيدر --}}
    <div class="relative bg-slate-900 py-16 overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10 z-0">
        </div>
        <div class="container mx-auto px-4 relative z-10 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2">تعديل بيانات المعدة</h1>
                <p class="text-slate-400">يمكنك تحديث الصور، السعر، والمواصفات من هنا</p>
            </div>
            <a href="{{ route('provider.dashboard') }}"
                class="bg-white/10 text-white px-4 py-2 rounded-lg hover:bg-white/20 transition text-sm font-bold flex items-center gap-2">
                <i class="fa-solid fa-arrow-right"></i> عودة
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 -mt-10 relative z-20 pb-20 max-w-5xl">

        {{-- عرض أخطاء التحقق (Validation Errors) فقط --}}
        @if ($errors->any())
            <div class="bg-red-50 border-r-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-sm animate-fade-in-up">
                <div class="flex items-center gap-2 mb-2 font-bold">
                    <i class="fa-solid fa-circle-exclamation"></i> يرجى الانتباه:
                </div>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">
            @csrf
            @method('PUT')

            {{-- 1. البيانات الأساسية --}}
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-3">
                    <i class="fa-solid fa-pen-to-square text-orange-500"></i> البيانات الأساسية
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- العنوان --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">اسم المعدة</label>
                        <input type="text" name="title" value="{{ old('title', $item->title) }}" required
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition font-bold text-slate-800">
                    </div>

                    {{-- الفئة --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">الفئة</label>
                        <div class="relative">
                            <select name="category_id" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition cursor-pointer appearance-none">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    {{-- المدينة --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">المدينة</label>
                        <div class="relative">
                            <select name="city" required
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition cursor-pointer appearance-none">
                                @foreach (['صنعاء', 'عدن', 'تعز', 'حضرموت', 'إب'] as $city)
                                    <option value="{{ $city }}" {{ $item->city == $city ? 'selected' : '' }}>
                                        {{ $city }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    {{-- السعر --}}
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">سعر الإيجار اليومي</label>
                        <div class="relative">
                            <input type="number" name="price_per_day" step="0.01" min="0" required
                                value="{{ old('price_per_day', $item->price_per_day) }}"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 pl-16 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition font-bold text-lg">
                            <span class="absolute left-4 top-3 text-sm font-bold text-orange-600">YER</span>
                        </div>
                    </div>

                    {{-- الوصف --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">الوصف</label>
                        <textarea name="description" rows="4" required
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition resize-none">{{ old('description', $item->description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- 2. المواصفات الفنية --}}
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-3">
                    <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-list-check text-orange-500"></i> المواصفات الفنية
                    </h2>
                    <button type="button" onclick="addSpec()"
                        class="text-sm bg-slate-100 text-slate-700 px-3 py-1.5 rounded-lg hover:bg-slate-800 hover:text-white transition font-bold flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> إضافة
                    </button>
                </div>

                <div id="specs-container" class="space-y-3">
                    {{-- كود PHP آمن لفك التشفير وتجنب الأخطاء --}}
                    @php
                        $specifications = $item->specifications;
                        if (is_string($specifications)) {
                            // إذا كانت نص JSON، قم بفك تشفيرها
                            $decoded = json_decode($specifications, true);
                            // تأكد أن فك التشفير نجح وأعاد مصفوفة
                            $specifications = json_last_error() === JSON_ERROR_NONE ? $decoded : [];
                        } elseif (!is_array($specifications)) {
                            // إذا لم تكن مصفوفة ولا نص، اجعلها فارغة
                            $specifications = [];
                        }
                    @endphp

                    @if (count($specifications) > 0)
                        @foreach ($specifications as $key => $value)
                            <div class="flex gap-4 items-center">
                                <input type="text" name="spec_keys[]" value="{{ $key }}"
                                    class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
                                <input type="text" name="spec_values[]" value="{{ $value }}"
                                    class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
                                <button type="button" onclick="this.parentElement.remove()"
                                    class="text-red-400 hover:text-red-600 w-10 h-10 flex items-center justify-center rounded-lg hover:bg-red-50 transition"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>
                        @endforeach
                    @else
                        {{-- حقل فارغ افتراضي إذا لم توجد مواصفات --}}
                        <div class="flex gap-4 items-center">
                            <input type="text" name="spec_keys[]" placeholder="الخاصية (جديد)"
                                class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
                            <input type="text" name="spec_values[]" placeholder="القيمة"
                                class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
                        </div>
                    @endif
                </div>
            </div>

            {{-- 3. الصور --}}
            <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100">
                <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2 border-b border-gray-100 pb-3">
                    <i class="fa-solid fa-images text-orange-500"></i> الصور
                </h2>

                {{-- عرض الصور الحالية --}}
                @php
                    $currentImages = $item->images;
                    if (is_string($currentImages)) {
                        $decodedImg = json_decode($currentImages, true);
                        $currentImages = json_last_error() === JSON_ERROR_NONE ? $decodedImg : [];
                    }
                @endphp

                @if ($currentImages && is_array($currentImages) && count($currentImages) > 0)
                    <p class="text-sm font-bold text-slate-600 mb-3">الصور الحالية:</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        @foreach ($currentImages as $img)
                            <div class="relative group">
                                <img src="{{ asset($img) }}"
                                    class="w-full h-24 object-cover rounded-xl border border-gray-200">
                            </div>
                        @endforeach
                    </div>
                @endif

                <div
                    class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:bg-orange-50 hover:border-orange-300 transition relative group">
                    <input type="file" name="images[]" multiple accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImages(this)">
                    <div class="text-gray-500 group-hover:text-orange-600 transition">
                        <i class="fa-solid fa-cloud-arrow-up text-3xl mb-2"></i>
                        <p class="font-bold">إضافة صور جديدة</p>
                        <p class="text-xs mt-1 text-gray-400 group-hover:text-orange-400">سيتم إضافتها للصور الحالية</p>
                    </div>
                </div>

                {{-- منطقة معاينة الصور الجديدة --}}
                <div id="new-image-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6"></div>
            </div>

            {{-- أزرار الحفظ والإلغاء --}}
            <div class="flex justify-end gap-4 pt-4 pb-10">
                <button type="button" onclick="history.back()"
                    class="px-8 py-3 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-100 transition duration-300 cursor-pointer">
                    إلغاء
                </button>

                <button type="submit"
                    class="bg-orange-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-orange-700 transition shadow-lg shadow-orange-600/20 flex items-center gap-2">
                    <i class="fa-solid fa-check"></i> حفظ التعديلات
                </button>
            </div>
        </form>
    </div>

    <script>
        function addSpec() {
            const container = document.getElementById('specs-container');
            const div = document.createElement('div');
            div.className = 'flex gap-4 items-center mt-3 animate-fade-in';
            div.innerHTML = `
                <input type="text" name="spec_keys[]" placeholder="الخاصية" class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
                <input type="text" name="spec_values[]" placeholder="القيمة" class="w-1/2 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 transition">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 w-10 h-10 flex items-center justify-center rounded-lg hover:bg-red-50 transition"><i class="fa-solid fa-trash"></i></button>
            `;
            container.appendChild(div);
        }

        // معاينة الصور الجديدة فقط
        function previewImages(input) {
            const container = document.getElementById('new-image-preview');
            container.innerHTML = '';

            if (input.files) {
                Array.from(input.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'animate-fade-in-up';
                        div.innerHTML =
                            `<img src="${e.target.result}" class="w-full h-24 object-cover rounded-xl border border-green-200 shadow-sm transition ring-2 ring-green-100">`;
                        container.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
@endsection
