<?php
namespace App\Admin\Packages\Services;

use App\Admin\Packages\DTOs\PackageData;
use App\Models\Package;
use Laravel\Cashier\Cashier;

class Create
{
    public function execute(
        PackageData $data
    ){
        $stripe = Cashier::stripe();
        $product = $stripe->products->create([
            'name' => $data->title,
        ]);
        $price = $stripe->prices->create([
            'product' => $product->id,
            'unit_amount' => $data->price->amountInCent,
            'currency' => 'usd',
            'recurring' => [
                "interval" => "month",
                "interval_count" => "1",
            ],
        ]);
        $pk = new Package();
        $pk->title = $data->title;
        $pk->price = $data->price->amountInCent;
        $pk->status = $data->status;
        $pk->forms_number = $data->formsNumber;
        $pk->responses_number = $data->responsesNumber;
        $pk->price_id = $price->id;
        $pk->product_id = $product->id;
        $pk->saveOrFail();
    }
}