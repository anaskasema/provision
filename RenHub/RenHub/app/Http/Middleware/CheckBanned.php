<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckBanned
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_banned) {
            
            Auth::logout();
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // 👇 لاحظ هنا استخدمنا 'error' لكي تظهر حمراء في الكود الذي اضفناه
            return redirect()->route('login')->with('error', 'عذراً، تم حظر حسابك لمخالفة القوانين. يرجى التواصل مع الإدارة.');
        }

        return $next($request);
    }
}