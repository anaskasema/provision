<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // هنا نقوم بتعريف الأسماء المستعارة
        $middleware->alias([
            // 👇👇 هنا مربط الفرس: تفعيل الحظر والصلاحيات 👇👇
            'role' => \App\Http\Middleware\CheckRole::class,
            'banned' => \App\Http\Middleware\CheckBanned::class,
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
        $middleware->append(\App\Http\Middleware\CheckBanned::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
