<?php
namespace App\Admin\Subscriptions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {
        /** @var User $user */
        $user = Auth::user();
        $subscription = $user->subscription();
        $subscription && $subscription->package = Package::query()->where('price_id', $subscription->stripe_price)->firstOrFail();
        return view('admin.subscriptions.index', compact('subscription'));
    }

    /**
     * @param  string  $name
     * @return RedirectResponse
     */
    public function destroy(string $name): RedirectResponse
    {
        try {
            /** @var User $user */
            $user = Auth::user();

            $user->subscription($name)->cancel();

            return back()->with('status', __("Subscriptions is cancelled successfully"));
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }

    }

    /**
     * @param  string  $name
     * @return RedirectResponse
     */
    public function resume(string $name): RedirectResponse
    {
        try {
            /** @var User $user */
            $user = Auth::user();

            $user->subscription($name)->resume();

            return back()->with('status', __("resumed successfully"));
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }
}
