<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // ✅ هذا هو السطر المهم جداً

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // استخدام Auth::check() بدلاً من auth()->check() يفهمه المحرر بشكل أفضل
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'غير مصرح لك بدخول هذه المنطقة المحظورة');
        }

        return $next($request);
    }
}