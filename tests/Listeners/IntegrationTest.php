<?php
namespace Tests\Listeners;

use App\Enums\Integrations\Type;
use App\Enums\Responses\Status;
use App\Events\ResponseFinished;
use App\Listeners\Integration;
use App\Models\Form;
use App\Models\Response;
use App\Notifications\ResponseFinishedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class IntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_send_email()
    {
        $this->expectsNotification((new AnonymousNotifiable)->route('email', '1365831278@qq.com'), ResponseFinishedNotification::class);
        $form = Form::factory()->create();

        $response = Response::factory()->create([
            'form_id' => $form
        ]);
        $response->status = Status::finished();
        $response->saveOrFail();
        $event = new ResponseFinished($response);

        $integration = \App\Models\Integration::factory()->create([
            'user_id' => $form->user_id
        ]);
        $integration->status = \App\Enums\Integrations\Status::enable();
        $integration->type = Type::email();
        $integration->config = ['email' => '1365831278@qq.com'];
        $integration->saveOrFail();


        $listener = new Integration();
        $listener->handle($event);
    }

    public function test_it_can_not_send_email_by_integrations_status_disable()
    {
        Notification::fake();
        $form = Form::factory()->create();

        $response = Response::factory()->create([
            'form_id' => $form
        ]);
        $response->status = Status::finished();
        $response->saveOrFail();
        $event = new ResponseFinished($response);

        $integration = \App\Models\Integration::factory()->create([
            'user_id' => $form->user_id
        ]);
        $integration->status = \App\Enums\Integrations\Status::disable();
        $integration->type = Type::email();
        $integration->config = ['email' => '1365831278@qq.com'];
        $integration->saveOrFail();

        $listener = new Integration();
        $listener->handle($event);
        Notification::assertNotSentTo((new AnonymousNotifiable)->route('email', '1365831278@qq.com'), ResponseFinishedNotification::class);

    }

    public function test_it_can_not_send_email_by_response_status_ongoing()
    {
        Notification::fake();
        $form = Form::factory()->create();

        $response = Response::factory()->create([
            'form_id' => $form
        ]);
        $response->status = Status::ongoing();
        $response->saveOrFail();
        $event = new ResponseFinished($response);

        $integration = \App\Models\Integration::factory()->create([
            'user_id' => $form->user_id
        ]);
        $integration->status = \App\Enums\Integrations\Status::enable();
        $integration->type = Type::email();
        $integration->config = ['email' => '1365831278@qq.com'];
        $integration->saveOrFail();

        $listener = new Integration();
        $listener->handle($event);
        Notification::assertNotSentTo((new AnonymousNotifiable)->route('email', '1365831278@qq.com'), ResponseFinishedNotification::class);
    }
}