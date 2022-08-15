<?php
namespace App\Admin\Integrations\Http\Controllers;

use App\Enums\Integrations\Status;
use App\Http\Controllers\Controller;
use App\Models\Integration;
use Illuminate\Http\RedirectResponse;
use Throwable;

class IntegrationStatusController extends Controller
{
    /**
     * @param  int  $id
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(int $id): RedirectResponse
    {
        $integration = Integration::query()->creator()->findOrFail($id);

        $integration->status = $integration->status->equals(Status::disable()) ? Status::enable() : Status::disable();

        $integration->saveOrFail();

        return redirect()->route('admin.integrations.index')->with('status', __('Saved successfully'));

    }
}