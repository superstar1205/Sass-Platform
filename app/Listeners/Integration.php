<?php

namespace App\Listeners;

use App\Enums\Integrations\Status;
use App\Enums\Integrations\Type;
use App\Events\ResponseFinished;
use App\Notifications\ResponseFinishedNotification;
use Illuminate\Support\Facades\Notification;

class Integration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ResponseFinished  $event
     * @return void
     */
    public function handle(ResponseFinished $event)
    {
        if ($event->response->status->equals(\App\Enums\Responses\Status::ongoing())) {
            return;
        }
        \App\Models\Integration::query()->where('user_id', $event->response->form->user_id)->enable()->get()->filter(function (\App\Models\Integration $integration){
            return $integration->status->equals(Status::enable());
        })->each(function (\App\Models\Integration $integration) use($event) {
            switch ($integration->type) {
                case Type::email():
                    if ($integration->email) {
                        Notification::route('email', $integration->email)->notify(new ResponseFinishedNotification($event->response));
                    }
                    break;
                default:
                    break;
            }

        });

    }
}
