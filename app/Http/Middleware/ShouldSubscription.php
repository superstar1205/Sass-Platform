<?php
namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

class ShouldSubscription
{
    public function handle($request, $next)
    {
        if (Auth::user()->not_admin && ! Auth::user()->subscribed()) {
            return redirect()->to('pricing');
        }
        return $next($request);
    }
}