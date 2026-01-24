<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عقد إيجار إلكتروني #{{ $booking->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Almarai', sans-serif;
            background-color: #f3f4f6;
        }

        @media print {
            body {
                background-color: white;
            }

            .no-print {
                display: none !important;
            }

            .print-container {
                box-shadow: none;
                border: 1px solid #ddd;
                margin: 0;
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body class="p-8">

    {{-- أزرار التحكم (لا تظهر عند الطباعة) --}}
    <div class="max-w-4xl mx-auto mb-6 flex justify-between items-center no-print">
        <a href="{{ url()->previous() }}" class="text-slate-600 font-bold hover:text-slate-900 flex items-center gap-2">
            <i class="fa-solid fa-arrow-right"></i> عودة للوحة التحكم
        </a>
        <button onclick="window.print()"
            class="bg-slate-900 text-white px-6 py-2 rounded-lg font-bold hover:bg-slate-800 transition shadow-lg flex items-center gap-2">
            <i class="fa-solid fa-print"></i> طباعة العقد
        </button>
    </div>

    {{-- ورقة العقد --}}
    <div class="print-container max-w-4xl mx-auto bg-white p-10 rounded-xl shadow-2xl border-t-8 border-slate-900">

        {{-- الترويسة --}}
        <div class="flex justify-between items-start border-b-2 border-slate-100 pb-8 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 mb-2">عقد إيجار معدة</h1>
                <p class="text-gray-500 font-bold">رقم المرجع: #{{ $booking->id }}</p>
                <p class="text-gray-400 text-sm mt-1">تاريخ التحرير: {{ $booking->updated_at->format('Y-m-d') }}</p>
            </div>
            <div class="text-left">
                <h2 class="text-2xl font-black text-orange-600 uppercase tracking-wider">RentHub</h2>
                <p class="text-xs text-slate-400 font-bold mt-1">منصة تأجير المعدات الموثوقة</p>
            </div>
        </div>

        {{-- أطراف العقد --}}
        <div class="grid grid-cols-2 gap-8 mb-8">
            {{-- الطرف الأول --}}
            <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
                <h3 class="text-sm font-black text-slate-900 uppercase mb-4 border-b border-slate-200 pb-2">الطرف الأول
                    (المؤجر)</h3>
                <ul class="space-y-2 text-sm text-slate-700">
                    <li><span class="font-bold ml-2">الاسم:</span> {{ $booking->item->user->first_name }}
                        {{ $booking->item->user->last_name }}</li>
                    <li><span class="font-bold ml-2">الهاتف:</span> <span
                            dir="ltr">{{ $booking->item->user->phone }}</span></li>
                    <li><span class="font-bold ml-2">البريد:</span> {{ $booking->item->user->email }}</li>
                </ul>
            </div>

            {{-- الطرف الثاني --}}
            <div class="bg-slate-50 p-6 rounded-xl border border-slate-100">
                <h3 class="text-sm font-black text-slate-900 uppercase mb-4 border-b border-slate-200 pb-2">الطرف الثاني
                    (المستأجر)</h3>
                <ul class="space-y-2 text-sm text-slate-700">
                    <li><span class="font-bold ml-2">الاسم:</span> {{ $booking->user->first_name }}
                        {{ $booking->user->last_name }}</li>
                    <li><span class="font-bold ml-2">الهاتف:</span> <span
                            dir="ltr">{{ $booking->user->phone }}</span></li>
                    <li><span class="font-bold ml-2">البريد:</span> {{ $booking->user->email }}</li>
                    @if ($booking->identity_image)
                        <li class="mt-2 text-green-600 font-bold text-xs"><i class="fa-solid fa-check-circle"></i> تم
                            التحقق من الهوية</li>
                    @endif
                </ul>
            </div>
        </div>

        {{-- تفاصيل المعدة --}}
        <div class="mb-8">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-box text-orange-500"></i> تفاصيل المعدة والمدة
            </h3>
            <table class="w-full text-sm border border-slate-200 rounded-lg overflow-hidden">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="p-3 text-right">المعدة</th>
                        <th class="p-3 text-right">المدينة</th>
                        <th class="p-3 text-right">تاريخ الاستلام</th>
                        <th class="p-3 text-right">تاريخ الإرجاع</th>
                        <th class="p-3 text-right">إجمالي المدة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr>
                        <td class="p-3 font-bold">{{ $booking->item->title }}</td>
                        <td class="p-3">{{ $booking->item->city }}</td>
                        <td class="p-3">{{ $booking->start_date->format('Y-m-d') }}</td>
                        <td class="p-3">{{ $booking->end_date->format('Y-m-d') }}</td>
                        <td class="p-3 font-bold">{{ $booking->start_date->diffInDays($booking->end_date) ?: 1 }} أيام
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- البيانات المالية --}}
        <div class="flex justify-end mb-10">
            <div class="w-64">
                <div class="flex justify-between py-2 border-b border-slate-100 text-sm">
                    <span class="text-gray-500">سعر اليوم</span>
                    <span class="font-bold">{{ number_format($booking->item->price_per_day) }}</span>
                </div>
                <div class="flex justify-between py-3 text-xl font-extrabold text-slate-900">
                    <span>الإجمالي</span>
                    <span>{{ number_format($booking->total_price) }} <span
                            class="text-xs text-orange-600">YER</span></span>
                </div>
                <div class="text-xs text-center bg-green-100 text-green-700 py-1 rounded font-bold mt-2">
                    <i class="fa-solid fa-check"></i> تم الاتفاق والتأكيد
                </div>
            </div>
        </div>

        {{-- الشروط والأحكام --}}
        <div class="mb-12">
            <h3 class="text-lg font-bold text-slate-900 mb-3">شروط وأحكام العقد</h3>
            <ul
                class="list-disc list-inside text-sm text-gray-600 space-y-1 leading-relaxed bg-gray-50 p-6 rounded-xl border border-gray-100">
                <li>يقر الطرف الثاني (المستأجر) بأنه قام بمعاينة المعدة المؤجرة وقبلها بحالتها الراهنة.</li>
                <li>يلتزم المستأجر باستخدام المعدة في الغرض المخصص لها والمحافظة عليها.</li>
                <li>يتحمل المستأجر المسؤولية الكاملة عن أي تلف أو فقدان للمعدة أثناء فترة التأجير.</li>
                <li>يجب إعادة المعدة في التاريخ المحدد أعلاه، وأي تأخير قد يترتب عليه رسوم إضافية.</li>
                <li>الضمانات المالية أو العينية (مثل البطاقة الشخصية) تخضع لاتفاق الطرفين وتُعاد بعد فحص المعدة.</li>
                <li>منصة RentHub هي وسيط تقني لربط الطرفين ولا تتحمل مسؤولية المنازعات المالية المباشرة.</li>
            </ul>
        </div>

        {{-- التوقيعات --}}
        <div class="grid grid-cols-2 gap-20 mt-12 pt-8 border-t-2 border-slate-100 border-dashed">
            <div class="text-center">
                <p class="font-bold text-slate-900 mb-10">توقيع الطرف الأول (المؤجر)</p>
                <div class="h-0.5 bg-slate-300 w-2/3 mx-auto"></div>
            </div>
            <div class="text-center">
                <p class="font-bold text-slate-900 mb-10">توقيع الطرف الثاني (المستأجر)</p>
                <div class="h-0.5 bg-slate-300 w-2/3 mx-auto"></div>
            </div>
        </div>

        {{-- الفوتر --}}
        <div class="mt-12 text-center text-[10px] text-gray-400">
            تم إصدار هذا المستند إلكترونياً عبر منصة RentHub ولا يحتاج إلى ختم في حال الموافقة الرقمية.
        </div>

    </div>

</body>

</html>
