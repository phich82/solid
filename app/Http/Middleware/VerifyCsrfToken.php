<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Fix a VerifyCsrfToken error when testing with POST request
     *
     * @param object $request
     * @param Closure $next
     * @return void
     */
    // public function handle($request, Closure $next)
    // {
    //     if (app()->environment() == 'testing') {
    //         return $next($request);
    //     }

    //     return parent::handle($request, $next);
    // }
}
