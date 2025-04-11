<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;

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
    public function register(): void{
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception){
    if ($request->expectsJson()) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }
        return redirect()->guest(route('login'))->with('error', 'Please log in to continue.');
    }
    public function render($request, Throwable $exception){
        if($exception instanceof AuthenticationException) {
            if($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated'], 401);
            }
            return redirect()->guest(route('login'))->with('error', 'Please log in to continue.');
        }
        if($exception instanceof TokenMismatchException) {
            if($request->is('logout')) {
                return redirect('/')->with('error', 'Session expired. Please log in again.');
            }
            return response()->view('errors.419', [], 419);
        }
        if($exception instanceof MethodNotAllowedHttpException) {
            return redirect('/')->with('error', 'Invalid request method.');
        }
        return parent::render($request, $exception);
        // return response()->view('errors.500', [], 500);
    }

       //     public function render($request, Throwable $exception){
    //     if ($exception instanceof TokenMismatchException) {
    //         if ($request->is('logout')) {
    //             return redirect('/')->with('error', 'Session expired. Please log in again.');
    //         }
    //         return response()->view('errors.419', [], 419);
    //     }
    //     else if($exception instanceof MethodNotAllowedHttpException) {
    //         return redirect('/')->with('error', 'Invalid request method.'); 
    //     }
    //     else{
    //         return response()->view('errors.500', [], 500);
    //     }
    //     // return parent::render($request, $exception);
    // }

}
