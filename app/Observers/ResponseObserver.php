<?php

namespace App\Observers;

use App\Enums\Responses\Status;
use App\Events\ResponseFinished;
use App\Models\Response;

class ResponseObserver
{
    public function saving(Response $response)
    {
        if ($response->getOriginal('status') !== 1 && $response->isDirty('status') && $response->status->equals(Status::finished())) {
            event(new ResponseFinished($response));
        }
    }
}
