<?php
namespace App\Forms\Http\Controllers;

use App\Enums\Responses\Status;
use App\Forms\Repositories\FormRepository;
use App\Generator\Form\Builder;
use App\Http\Controllers\Controller;
use App\Models\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Throwable;

class FormController extends Controller
{
    /**
     * @param  string  $slugFormId
     * @param  int  $response
     * @param  FormRepository  $repository
     * @return Redirector|Builder
     */
    public function thankyou(string $slugFormId, int $response,FormRepository $repository): RedirectResponse|Builder
    {
        $rp = Response::query()->findOrFail($response);
        $rp->status = Status::finished();
        $rp->saveOrFail();

        $form = $repository->findBySlugFormId($slugFormId);
        $metaData = $form->meta_data;
        if (data_get($metaData, 'thank_you_page.redirect') === true) {
            return redirect()->away(data_get($metaData, 'redirect'));
        }
        $metaData['current_page'] = "thank_you_page";
        return Builder::make($metaData);
    }
}