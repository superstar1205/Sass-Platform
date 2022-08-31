<?php
namespace App\Subscriptions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Contracts\View\View;

class PricingsController extends Controller
{
    /**
     * @return View
     */
    public function pricing():View
    {
        $packages = Package::query()->visible()->get();
        return view('subscriptions.pricing', compact('packages'));
    }
}