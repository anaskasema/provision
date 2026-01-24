<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. التأكد أن المستخدم مسجل دخول
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. فحص الدور
        // التعديل: السماح بالمرور إذا كان الدور مطابقاً، أو إذا كان المستخدم "أدمن"
        // هذا يسمح للأدمن بدخول صفحات المزودين
        if ($request->user()->role !== $role && $request->user()->role !== 'admin') {
            abort(403, 'غير مصرح لك بدخول هذه المنطقة.');
        }

        return $next($request);
    }
}
