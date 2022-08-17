<?php

namespace App\Events;

use App\Models\Response;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResponseFinished
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Response $response;

    /**
     * Create a new event instance.
     *
     * @param  Response  $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
