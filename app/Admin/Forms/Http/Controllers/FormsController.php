<?php

namespace App\Admin\Forms\Http\Controllers;

use App\Admin\Forms\Exceptions\FormsLimitException;
use App\Admin\Forms\Repositories\FormsLimitRepository;
use App\Admin\Forms\Services\Create;
use App\Admin\Forms\Services\Update;
use App\Forms\Repositories\ResponsesLimitRepository;
use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Throwable;

class FormsController extends Controller
{

    public function __construct()
    {
        Form::addGlobalScope('user_id', function (Builder $builder) {
            if (! Auth::user()->is_admin) {
                $builder->creator();
            }
        });
    }

    /**
     * @param  ResponsesLimitRepository  $repository
     * @return View
     */
    public function index(ResponsesLimitRepository $repository): View
    {
        $canShare = $repository->check(Auth::user());

        $forms = Form::query()
            ->when(Auth::user()->is_admin, function (Builder $builder){return $builder->with('user');})
            ->latest()
            ->paginate(10);

        return view('admin.forms.index', compact('forms', 'canShare'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.forms.create');
    }


    /**
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $form = Form::query()->findOrFail($id);
        return view('admin.forms.edit', compact('form'));
    }

    /**
     * @param  int  $id
     * @param  Request  $request
     * @param  Update  $update
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(int $id, Request $request, Update $update): JsonResponse
    {
        try {
            $form = Form::query()->findOrFail($id);
            $update->execute($form, $request->input('name'), $request->input(), Auth::id());
            return Response::json([]);
        } catch (\Exception $exception) {
            return Response::json(['message' => $exception->getMessage()], 500);
        }

    }

    /**
     * @param  Request  $request
     * @param  Create  $create
     * @param  FormsLimitRepository  $repository
     * @return JsonResponse
     */
    public function store(Request $request, Create $create, FormsLimitRepository $repository): JsonResponse
    {
        try {
            if (! $repository->check(Auth::user())) {
                throw new FormsLimitException("The number of created forms exceeds the limit.");
            }
            $create->execute($request->input('name'), $request->input(), Auth::user());
            return Response::json([]);
        } catch (\Exception $exception) {
            return Response::json(['message' => $exception->getMessage()], 500);
        }
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            Form::query()->where('id', $id)->delete();
            return Response::json([]);
        } catch (\Exception $exception) {
            return Response::json(['message' => $exception->getMessage()], 500);
        }
    }
}
