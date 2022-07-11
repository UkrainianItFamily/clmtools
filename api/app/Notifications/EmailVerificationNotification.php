<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;

class EmailVerificationNotification extends VerifyEmail
{
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        $query  = explode('&', $verificationUrl);
        $preUrl = explode('?', $query[0]);
        $expires = explode('=', $preUrl[1]);
        $hash = explode('=', $query[1]);
        $signature = explode('=', $query[2]);

        $customUrl = env('APP_URL') .
            '/verify-email/' . $notifiable->id .
            '?expires=' . $expires[1] .
            '&hash=' . $hash[1] .
            '&signature=' . $signature[1];

        return (new MailMessage)
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email Address', $customUrl)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
