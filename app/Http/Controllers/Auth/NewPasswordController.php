<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     *
     * @param  Request  $request
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        return view('auth.reset-password', compact('user'));
    }

    /**
     * Handle an incoming new password request.
     *
     * @param  Request  $request
     * @return RedirectResponse
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();

        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->saveOrFail();

        return redirect()->route('password.reset')->with('status', __("Saved successfully"));
    }
}
