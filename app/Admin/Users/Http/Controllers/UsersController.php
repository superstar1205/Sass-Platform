<?php
namespace App\Admin\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * @return View
     */
    public function index():View
    {
        $users = User::query()
            ->whereHas('subscriptions', function (Builder $builder){
                return $builder->active();
            })
            ->paginate();

        $users->getCollection()->transform(function (User $user){
            $user->subscription = $user->subscription();
            if ($user->subscription) {
                $user->package = Package::query()->where('price_id', $user->subscription->stripe_price)->firstOrFail();
            }
            return $user;
        });

        return view('admin.users.index', compact('users'));
    }

    public function edit(int $id): View
    {
        $user = User::query()->findOrFail($id);
        $packages = Package::query()->visible()->latest()->pluck('title', 'price_id');
        return view('admin.users.edit', compact('user', 'packages'));
    }

    /**
     * @param  int  $id
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        try {

            $user = User::query()->findOrFail($id);
            $user->subscription()->swap($request->post('price_id'));
            return back()->with('status', __("Saved successfully"));
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }

    }
}