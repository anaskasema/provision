@if (session('success') || session('error') || session('warning') || session('info'))
    
    {{-- 1. كود SweetAlert2 (يظهر نافذة منبثقة جميلة) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: "{{ session('success') ? 'success' : (session('error') ? 'error' : (session('warning') ? 'warning' : 'info')) }}",
                title: "{{ session('success') ? 'تمت العملية بنجاح' : (session('error') ? 'خطأ!' : 'تنبيه') }}",
                text: "{{ session('success') ?? session('error') ?? session('warning') ?? session('info') }}",
                confirmButtonColor: '#1e293b', // لون كحلي متناسق
                confirmButtonText: 'حسناً',
                timer: 5000,
                timerProgressBar: true
            });
        });
    </script>

    {{-- 2. رسالة نصية تظهر أعلى الصفحة (اختياري - كحماية إضافية) --}}
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
         class="mb-6 p-4 rounded-xl border flex items-center gap-3 shadow-sm animate-fade-in-up
         {{ session('success') ? 'bg-green-50 border-green-200 text-green-700' : '' }}
         {{ session('error') ? 'bg-red-50 border-red-200 text-red-700' : '' }}
         {{ session('warning') ? 'bg-yellow-50 border-yellow-200 text-yellow-700' : '' }}
         {{ session('info') ? 'bg-blue-50 border-blue-200 text-blue-700' : '' }}">
        
        <i class="text-xl fa-solid 
            {{ session('success') ? 'fa-circle-check' : '' }}
            {{ session('error') ? 'fa-circle-xmark' : '' }}
            {{ session('warning') ? 'fa-triangle-exclamation' : '' }}
            {{ session('info') ? 'fa-circle-info' : '' }}">
        </i>
        
        <span class="font-bold">
            {{ session('success') ?? session('error') ?? session('warning') ?? session('info') }}
        </span>

        {{-- زر إغلاق صغير --}}
        <button @click="show = false" class="mr-auto hover:opacity-75 transition">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

@endif