<?php
namespace App\Http\Middleware;

class StripeCanNotEmpty
{
    public function handle($request, $next)
    {
        if (! config('cashier.key') || ! config('cashier.secret')) {
            return redirect()
                ->route('admin.envs.create')
                ->withErrors(['Please provide STRIPE_KEY and STRIPE_SECRET in order to use the SaaS modules']);
        }
        return $next($request);
    }
}
