<?php
namespace App\Admin\Forms\Repositories;

use App\Models\Form;
use App\Models\Package;
use App\Models\User;

class FormsLimitRepository
{
    public function check(User $user): bool
    {
        if ($user->is_admin) {
            return true;
        }

        if ($user->subscribed()) {
            $formsLimit = Package::query()->where('price_id', $user->subscription()->stripe_price)->value('forms_number');
            $count = Form::query()->creator()->count();
            return $count < $formsLimit;
        }
        return false;
    }
}