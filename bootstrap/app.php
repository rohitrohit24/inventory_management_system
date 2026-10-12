<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // \Throwable use kiya hai bina top use statement ke
        $exceptions->render(function (\Throwable $e, Request $request) {

            // Status code nikalne ka sabse safe tarika
            $status = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Title set karne ke liye
            $title = match ($status) {
                404 => 'Page Not Found',
                400 => 'Bad Request',
                429 => 'Too Many Request',
                403 => 'Forbidden Access',
                401 => 'Unauthorized',
                500 => 'Internal Server Error',
                503 => 'Service Unavailable',
                504 => 'Gateway Timeout',
                default => 'Something Went Wrong',
            };

            // Custom error message
            $message = $e->getMessage() ?: "Sorry, we encountered an error while processing your request.";

            // 'errors.any' view render hoga saare variables ke sath
            return response()->view('errors.any', [
                'status'  => $status,
                'title'   => $title,
                'message' => $message
            ], $status);
        });
    })->create();
