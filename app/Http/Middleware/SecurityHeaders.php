<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        // $response->headers->set('X-Content-Type-Options', 'nosniff');
        // $response->headers->set('X-XSS-Protection', '1; mode=block');
        // $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        // $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');
        /* 
        $viteDev = app()->environment('local') 
            ? "http://localhost:5173 http://127.0.0.1:5173 http://[::1]:5173 ws://localhost:5173 ws://127.0.0.1:5173 ws://[::1]:5173 "
            : "";

        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net {$viteDev}; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net {$viteDev}; " .
            "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com data:; " .
            "img-src 'self' data: blob: https: http:; " .
            "connect-src 'self' {$viteDev}; " .
            "frame-src 'self' https://maps.google.com https://www.google.com; " .
            "object-src 'none'; " .
            "base-uri 'self';"
        );
        */

        // Remove server fingerprinting headers
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
