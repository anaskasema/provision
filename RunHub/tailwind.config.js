import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // تغيير الخط إلى المراعي
                sans: ['Almarai', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // اللوحة اللونية الجديدة
                primary: {
                    DEFAULT: '#0F172A', // كحلي غامق جداً (للهيدر والنصوص الأساسية)
                    light: '#1E293B',   // كحلي أفتح قليلاً
                    hover: '#334155',
                },
                accent: {
                    DEFAULT: '#F97316', // برتقالي حيوي (للأزرار المهمة) - واضح جداً
                    hover: '#EA580C',   // برتقالي أغمق عند الضغط
                    light: '#FFF7ED',   // برتقالي فاتح جداً للخلفيات
                },
                surface: {
                    DEFAULT: '#F8FAFC', // رمادي ثلجي للخلفية العامة
                    card: '#FFFFFF',    // أبيض ناصع للكروت
                }
            },
            boxShadow: {
                'soft': '0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03)',
                'glow': '0 0 15px rgba(249, 115, 22, 0.3)', // توهج خفيف للأزرار
            }
        },
    },

    plugins: [forms],
    
};
