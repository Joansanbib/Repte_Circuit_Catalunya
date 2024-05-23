<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('404', [], 404);
        } elseif ($exception instanceof AuthorizationException) {
            return response()->view('403', [], 403);
        }
        return parent::render($request, $exception);
        // if ($request->expectsJson() || $request->is('api/*')) {
        //     $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;
        //     \Log::error('Exception: ' . $exception->getMessage(), ['exception' => $exception]);
        //     return response()->json([
        //         'message' => $exception->getMessage(),
        //         'status' => 'error',
        //         'trace' => $exception->getTrace() // Add trace to debug
        //     ], $statusCode);
        // }

        // return parent::render($request, $exception);
    }
}
