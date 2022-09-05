<?php
namespace App\Subscriptions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SubscriptionsController extends Controller
{
    /**
     * @param  int  $packageId
     * @return View
     */
    public function create(int $packageId):View
    {
        /** @var User $user */
        $user = Auth::user();
        return view('subscriptions.create', [
            'intent' => $user->createSetupIntent(),
            'package_id' => $packageId
        ]);
    }

    /**
     * @param  int  $packageId
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(int $packageId, Request $request): JsonResponse
    {
        try {
            $package = Package::query()->findOrFail($packageId);
            /** @var User $user */
            $user = Auth::user();
            $user->subscribe($package->price_id, $request->post('payment_method'));
            return Response::json(['message' => 'Subscription succeeded']);
        } catch (\Exception $exception) {
            return Response::json(['message' => $exception->getMessage()], 500);
        }
    }


    /**
     * @return View
     */
    public function success():View
    {
        return view('subscriptions.success');
    }

    /**
     * @return View
     */
    public function cancel():View
    {
        return view('subscriptions.cancel');
    }
}