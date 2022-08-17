<?php
namespace App\Admin\Packages\Http\Controllers;

use App\Admin\Packages\DTOs\PackageData;
use App\Admin\Packages\Http\Requests\PackageRequest;
use App\Admin\Packages\Services\Create;
use App\Admin\Packages\Services\Update;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PackagesController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $packages = Package::query()->latest()->paginate();
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.packages.create');
    }


    /**
     * @param  PackageRequest  $request
     * @param  Create  $create
     * @return RedirectResponse
     */
    public function store(PackageRequest $request, Create $create): RedirectResponse
    {
        try {
            $create->execute(PackageData::fromRequest($request));
            return redirect()->to(route('admin.packages.index'));
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }

    /**
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $package = Package::query()->findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * @param  int  $id
     * @param  PackageRequest  $request
     * @param  Update  $update
     * @return RedirectResponse
     */
    public function update(int $id, PackageRequest $request, Update $update)
    {
        try {
            $package = Package::query()->findOrFail($id);
            $update->execute($package, PackageData::fromRequest($request));
            return back()->with('status', __("Updated successfully"));
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage());
        }
    }
}