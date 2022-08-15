<?php
namespace App\Admin\Forms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class UploadController extends Controller
{

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->file(),
                [
                   'images' => 'required|image'
                ],
            );

            if ($validator->fails()) {
                return Response::json(['message' => $validator->errors()->all()[0]], 400);
            }

            $path = $request
                ->file('images')
                ->store('images','logo');


            return Response::json(['url' => Storage::url($path)]);

        } catch (\Exception $exception) {
            return Response::json(['message' => $exception->getMessage()], 400);
        }

    }
}
