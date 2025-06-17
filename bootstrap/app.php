<?php

use App\Http\Middleware\AuthenticateAdmin;
use App\Http\Middleware\AuthenticateStudent;
use App\Http\Middleware\AuthenticateTeacher;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('auth.admin', [AuthenticateAdmin::class]);
        $middleware->group('auth.teacher', [AuthenticateTeacher::class]);
        $middleware->group('auth.student', [AuthenticateStudent::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
