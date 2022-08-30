<?php

namespace App\Notifications;

use App\Models\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;

class ResponseFinishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Response $response;

    /**
     * Create a new notification instance.
     *
     * @param  Response  $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $form = $this->response->form;
        $title = $form->title;
        $data = $this->response->form_data;
        $fields = collect(Arr::collapse(Arr::pluck(Arr::get($form->meta_data, 'pages', []),'blocks')))->pluck('label', 'id')->toArray();
        return (new MailMessage)
                    ->markdown('mail.response_finished', compact('data', 'fields', 'title'));
    }
}
