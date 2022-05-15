<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExportReady extends Notification
{
    use Queueable;

    public $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
                    ->line(trans('messages.exportready.ready'))
                    ->action(trans('messages.exportready.download'), $this->filePath)
                    ->line(trans('messages.exportready.day'));
    }
}
