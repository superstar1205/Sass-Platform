<?php

namespace App\Admin\Responses\Http\Controllers;

use App\Admin\Responses\Repositories\ResponseRepository;
use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Response;
use App\Support\CsvWriter;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ResponsesController extends Controller
{
    public function __construct()
    {
        Form::addGlobalScope('user_id', function (Builder $builder) {
            if (! Auth::user()->is_admin) {
                $builder->creator();
            }
        });

        Response::addGlobalScope('user_id',function (Builder $builder) {
            if (! Auth::user()->is_admin) {
                $builder->creator();
            }
        });
    }

    public function index(Request $request, CsvWriter $csvWriter, ResponseRepository $responseRepository): ?View
    {
        $formId = $request->get('form_id');
        $currentMetaData = Form::query()->where('id', $formId)->value('meta_data') ?? [];
        $headers = $responseRepository->getHeadersByMetaData($currentMetaData);

        $forms = Form::query()->latest()->pluck('title', 'id');

        $formDatas = $responseRepository->pluck('form_data', $formId);

        $rows = $responseRepository->getRows($headers, $formDatas->toArray());

        $responseIds = $responseRepository->pluck('id', $formId);

        $headers = Arr::pluck($headers, 'label');

        if ($request->input('export') && $formDatas->isNotEmpty()) {
            $csvWriter->write($headers, $rows, 'responses-'.now()->format('d-m-Y'));
            return null;
        }

        $hasForm = Form::query()->count() > 0;
        $selectedForm = Form::query()->find($formId);
        return view('admin.responses.index',
            compact('formDatas', 'forms', 'rows', 'headers', 'hasForm', 'selectedForm', 'responseIds'));
    }

    public function show($id, ResponseRepository $responseRepository)
    {
        $response = Response::query()->with('form')->where('id', $id)->first();

        $formId = $response['form_id'];

        $currentMetaData = Form::query()->where('id', $formId)->value('meta_data') ?? [];

        $headers = $responseRepository->getHeadersByMetaData($currentMetaData);

        return view('admin.responses.show', compact('response', 'headers'));

    }

    public function destroy($id)
    {
        $response = Response::query()->with('form')->where('id', $id)->first();

        $formId = $response['form_id'];

        $response->deleteOrFail();

        return redirect()
            ->route('admin.responses.index', ['form_id' => $formId])
            ->with('status', __('Response is delete successfully'));
    }
}
