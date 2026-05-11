<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BranchAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        if (!auth()->user()->isBranchAdmin() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Access denied.');
        }

        return $next($request);
    }
}
