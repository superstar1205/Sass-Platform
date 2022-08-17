<?php
namespace App\Forms\Repositories;

use App\Models\Package;
use App\Models\Response;
use App\Models\User;

class ResponsesLimitRepository
{
    public function check(User $user): bool
    {
        if ($user->is_admin) {
            return true;
        }

        if ($user->subscribed()) {
            $responsesLimit = Package::query()->where('price_id', $user->subscription()->stripe_price)->value('responses_number');
            $count = Response::query()->creator()->count();
            return $count < $responsesLimit;
        }

        return false;
    }
}