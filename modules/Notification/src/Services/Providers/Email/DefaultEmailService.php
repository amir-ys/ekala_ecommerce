<?php

namespace Modules\Notification\Services\Providers\Email;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Modules\Notification\Mail\CustomEmail;
use Modules\User\Models\User;

class DefaultEmailService
{
    public function send(User $user , $mailable)
    {
        if ($mailable instanceof Mailable) {
            Mail::to($user)->send($mailable);
        }else {
            Mail::to($user)->send(new CustomEmail($user->email ,$mailable));
        }
    }

}
