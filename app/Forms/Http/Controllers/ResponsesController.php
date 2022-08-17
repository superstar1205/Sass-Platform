<?php
namespace App\Forms\Http\Controllers;

use App\Enums\Responses\Status;
use App\Forms\Exceptions\ResponsesLimitException;
use App\Forms\Repositories\FormRepository;
use App\Forms\Repositories\ResponsesLimitRepository;
use App\Generator\Form\Builder;
use App\Http\Controllers\Controller;
use App\Models\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ResponsesController extends Controller
{
    /**
     * @param  string  $slugFormId
     * @param  FormRepository  $repository
     * @param  ResponsesLimitRepository  $limitRepository
     * @return Builder|JsonResponse
     */
    public function create(string $slugFormId, FormRepository $repository, ResponsesLimitRepository $limitRepository)
    {
        try {
            $form = $repository->findBySlugFormId($slugFormId);

            if (! $limitRepository->check($form->user)) {
                throw new ResponsesLimitException("The number of created responses exceeds the limit.", 403);
            }

            $metaData = $form->meta_data;
            $metaData['current_page'] = request('current_page', 1);
            \App\Generator\Form\Form::setAction(route('forms.responses.store', $slugFormId));
            return Builder::make($metaData);
        } catch (\Exception $exception) {
            return \Illuminate\Support\Facades\Response::json(['message' => $exception->getMessage()], $exception->getCode());
        }

    }

    /**
     * @param  string  $slugFormId
     * @param  FormRepository  $repository
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(string $slugFormId, FormRepository $repository, Request $request): RedirectResponse
    {
        $form = $repository->findBySlugFormId($slugFormId);
        $metaData = $form->meta_data;

        $response = Response::query()->create([
            'form_id' => $form->id,
            'status' => Status::ongoing(),
            'form_data' => $request->except(['_method', '_token', 'current_page'])
        ]);

        if (count(data_get($metaData, 'pages')) > request('current_page')) {
            return redirect()->route("forms.responses.edit", [
                'slugFormId' => $slugFormId,
                'response' => $response->id,
                'current_page' => $request->input('current_page') + 1
            ]);
        } else {
            return redirect()->route('forms.thankyou', [
                'slugFormId' => $slugFormId,
                'response' => $response->id
            ]);
        }
    }

    /**
     * @param  string  $slugFormId
     * @param  FormRepository  $repository
     * @param  int  $responseId
     * @return Builder
     */
    public function edit(string $slugFormId, int $responseId, FormRepository $repository): Builder
    {
        $form = $repository->findBySlugFormId($slugFormId);
        $metaData = $form->meta_data;
        $metaData['current_page'] = request('current_page', 1);

        \App\Generator\Form\Form::setAction(route('forms.responses.update', [$slugFormId, $responseId]));
        \App\Generator\Form\Form::setMethod('put');
        return Builder::make($metaData);
    }


    /**
     * @param  string  $slugFormId
     * @param  int  $responseId
     * @param  FormRepository  $repository
     * @param  Request  $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(string $slugFormId, int $responseId, FormRepository $repository, Request $request): RedirectResponse
    {
        $form = $repository->findBySlugFormId($slugFormId);
        $metaData = $form->meta_data;

        $response = Response::query()->findOrFail($responseId);
        $response->form_data = array_merge($response->form_data, $request->except(['_method', '_token', 'current_page']));
        $response->saveOrFail();

        if (count(data_get($metaData, 'pages')) > $request->input('current_page')) {
            return redirect()->route("forms.responses.edit", [
                'slugFormId' => $slugFormId,
                'response' => $response->id,
                'current_page' => $request->input('current_page') + 1
            ]);
        } else {
            return redirect()->route('forms.thankyou', [
                'slugFormId' => $slugFormId,
                'response' => $response->id
            ]);
        }
    }
}