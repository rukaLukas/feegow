<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            return response()->json([
                'message' => 'endpoint não encontrado'
            ], 404);
        }

        if ($exception instanceof ValidationException) {       
            return response($exception->errors(), 422);
            // return $this->error($this->messageErrorDefault, $e->errors());
        }

        if ($exception instanceof \Exception) {
            return response('', 500);
        }

        return parent::render($request, $exception);
    }
}
