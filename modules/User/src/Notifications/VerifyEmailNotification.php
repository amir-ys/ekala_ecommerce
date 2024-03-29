<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Modules\User\Mail\VerifyCodeMail;
use Modules\User\Services\EmailVerify\EmailVerifyService;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return VerifyCodeMail
     */
    public function toMail(mixed $notifiable): VerifyCodeMail
    {
        $code = EmailVerifyService::generateCode();

        EmailVerifyService::store($notifiable->id, $code, now()->addHour());

        return (new VerifyCodeMail($code))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
