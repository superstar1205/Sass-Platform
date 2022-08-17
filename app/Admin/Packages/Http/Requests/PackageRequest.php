<?php
namespace App\Admin\Packages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string'],
          //  'price' => ['required', 'numeric'],
            'forms_number' => ['required', 'integer'],
            'responses_number' => ['required', 'integer'],
            'status' => ['required', 'integer']
        ];
    }
}