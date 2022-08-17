<?php
namespace App\Admin\Packages\Services;

use App\Admin\Packages\DTOs\PackageData;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Cashier;

class Update
{
    public function execute(
        Model $package,
        PackageData $data
    ){
        $stripe = Cashier::stripe();
        $stripe->products->update($package->product_id,[
            'name' => $data->title
        ]);

        $package->title = $data->title;
        //$package->price = $data->price->amountInCent;
        $package->status = $data->status;
        $package->forms_number = $data->formsNumber;
        $package->responses_number = $data->responsesNumber;
        $package->saveOrFail();
    }
}