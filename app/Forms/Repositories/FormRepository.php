<?php
namespace App\Forms\Repositories;

use App\Models\Form;
use Illuminate\Database\Eloquent\Model;

class FormRepository
{
    /**
     * @param  string  $slugFormId
     * @return Form
     */
    public function findBySlugFormId(string $slugFormId):Model
    {
        $formId = last(explode("-", $slugFormId));
        return Form::query()->findOrFail($formId);
    }
}