<?php
namespace App\Admin\Integrations\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Integration;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class IntegrationsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $integrations = Integration::query()->creator()->latest()->get();
        return view('admin.integrations.index', compact('integrations'));
    }

    /**
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $integration = Integration::query()->creator()->findOrFail($id);
        return view('admin.integrations.edit', compact('integration'));
    }

    /**
     * @param  int  $id
     * @param  Request  $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'name' => ['required'],
                'desc' => ['required'],
                'email' => ['required', 'email']
            ]);

            $integration = Integration::query()->creator()->findOrFail($id);

            $integration->name = $request->input('name');
            $integration->desc = $request->input('desc');
            $integration->config = ['email' => $request->input('email')];
            $integration->saveOrFail();

            return back()->with('status', __("Saved successfully"));
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }

    }
}