<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class CheckWalletConnection
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            // User is logged in
            return redirect()->route('dashboard.index');
        }
        return $next($request);
    }
}
