<?php

namespace App\Http\Middleware;
namespace App\Models;


use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuditTrailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        AuditTrail::create([
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'menu_accessed' => $request->path(),
            'method' => $request->method(),
            'access_time' => now(),
        ]);

        return $response;
    }

}
