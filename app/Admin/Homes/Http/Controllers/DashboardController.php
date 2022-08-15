<?php


namespace App\Admin\Homes\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): ?View
    {
        $formsCreated = Form::query()->when(Auth::user()->not_admin, function (Builder $builder){
            return $builder->creator();
        })->count();

        $hasForm = $formsCreated > 0;

        $responsesCollected = Response::query()->when(Auth::user()->not_admin, function (Builder $builder){
            return $builder->creator();
        })->count();

        return view('admin.dashboard.index', compact('hasForm', 'formsCreated', 'responsesCollected'));
    }
}
