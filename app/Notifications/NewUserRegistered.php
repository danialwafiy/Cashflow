<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class NewUserRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)

        ->to('#random')

        ->content('New user has registered')    

        ->attachment(function ($attachment) use ($notifiable){

            $attachment->title('User',url('/user/1'))

                ->fields([
                    'Name' => $notifiable->name,
                    'Email' => $notifiable->email
                ]);
        });
    }
}
