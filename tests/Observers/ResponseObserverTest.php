<?php
namespace Tests\Observers;

use App\Enums\Responses\Status;
use App\Events\ResponseFinished;
use App\Models\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResponseObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_response_status_is_ongoing()
    {
        $this->doesntExpectEvents(ResponseFinished::class);
        $response = Response::factory()->create();
        $response->status = Status::ongoing();
        $response->saveOrFail();
    }

    public function test_response_status_is_finished()
    {
        $this->expectsEvents(ResponseFinished::class);
        $response = Response::factory()->create();
        $response->status = Status::finished();
        $response->saveOrFail();
    }
}

