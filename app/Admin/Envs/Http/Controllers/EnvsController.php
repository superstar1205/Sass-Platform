<?php
namespace App\Admin\Envs\Http\Controllers;

use App\Admin\Envs\DTOs\EnvData;
use App\Admin\Envs\Services\Create;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EnvsController extends Controller
{
    public function create():View
    {
        return view('admin.envs.create');
    }

    /**
     * @param  Request  $request
     * @param  Create  $create
     * @return RedirectResponse
     */
    public function store(Request $request, Create $create): RedirectResponse
    {
        try {
            $create->execute(EnvData::fromRequest($request));
            return back()->with('status', __("Saved successfully"));
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }
}