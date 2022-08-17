<?php
namespace App\Admin\Packages\DTOs;

use App\ValueObjects\Money;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class PackageData extends DataTransferObject
{
    public string $title;

    public Money $price;

    public int $formsNumber;

    public int $responsesNumber;

    public int $status;

    public static function fromRequest(Request $request): self
    {
        return new self([
            'title' => $request->input('title'),
            'price' => Money::withDefaultCurrency(bcmul($request->input('price', 0), 100)),
            'status' => intval($request->input('status')),
            'formsNumber' => intval($request->input('forms_number')),
            'responsesNumber' => intval($request->input('responses_number')),
        ]);
    }
}