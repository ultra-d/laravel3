<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportHasFailedNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
                    ->line(trans('messages.importhasfailed.sorry'))
                    ->line(trans('messages.importhasfailed.category_id'))
                    ->line(trans('messages.importhasfailed.code'))
                    ->line(trans('messages.importhasfailed.title'))
                    ->line(trans('messages.importhasfailed.description'))
                    ->line(trans('messages.importhasfailed.slug'))
                    ->line(trans('messages.importhasfailed.price'))
                    ->line(trans('messages.importhasfailed.quantity'));
    }
}
