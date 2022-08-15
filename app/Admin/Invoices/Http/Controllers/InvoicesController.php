<?php
namespace App\Admin\Invoices\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index(Request $request):View
    {
        $users = User::query()->has('subscriptions')->pluck('name', 'id');

        $selectedUser = User::query()->has('subscriptions')->find($request->get('user_id'));

        return view('admin.invoices.index', compact('users', 'selectedUser'));
    }
}