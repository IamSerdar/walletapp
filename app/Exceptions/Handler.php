<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                  'status_code' => 401,
                  'success' => false,
                  'message' => 'Unauthenticated.'
                ], 401);
            }
           });
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'success' => 0,
            'error' => [
                'code' => $exception->validator->errors()->first(),
                'message' => null,
                'meta' => [
                    'key' => $exception->validator->errors()->first(null, ':key')
                ],
            ],
        ], $exception->status);
    }
}
