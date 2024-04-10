<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/*')) {
            if (auth('api')->user()->user_type !== 'admin') {
                return response()->json(['error' => 'No access'], 403);
            }
        } else {
            if (auth()->user()->user_type !== 'admin') {
                return redirect()->route('home');
            }
        }
        return $next($request);
    }
}