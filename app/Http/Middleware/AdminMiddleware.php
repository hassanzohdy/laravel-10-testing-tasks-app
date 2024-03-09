<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AdminMiddleware extends Middleware
{
    /**
     * {@inheritDoc}
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (auth()->user()->is_admin) {
            return $next($request);
        }

        return redirect()->route('tasks.list');
    }
}
