<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class cekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$rules)
    {
        $user = Auth::user();
        if (!Auth::check()) {
            return redirect('login');
        }
        foreach ($rules as $rule) {
            // Check if user has the role This check will depend on how your roles are set up
            if ($user->role == $rule) {
                return $next($request);
            }
        }
        return redirect()->back()->with('error', 'kamu tidak punya akses');
    }
}
