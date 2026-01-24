<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // 1. البيانات الأساسية
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            
            // 2. البريد الإلكتروني (يجب أن يكون فريداً باستثناء المستخدم الحالي)
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                Rule::unique(User::class)->ignore($this->user()->id)
            ],

            // 3. البيانات الإضافية (الهاتف والمدينة)
            // جعلتها nullable (اختياري) حتى لا يحدث خطأ إذا تركها المستخدم فارغة، 
            // لكن يمكنك تغييرها إلى required إذا كنت تريد إجبار المستخدم.
            'phone' => ['nullable', 'string', 'max:20'], 
            'city'  => ['nullable', 'string', 'max:50'],

            // 4. الصورة الشخصية
            // image: يتأكد الملف صورة
            // mimes: صيغ الصور المسموحة
            // max: الحجم الأقصى بالكيلوبايت (2048 = 2MB)
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}