<?php

namespace Modules\Otp\Listeners;

use Modules\Notification\Facades\NotificationFacade;

class OtpCodeHasBeenSentToUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct( )
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        NotificationFacade::send(
            $event->otp->phone_number ,
            trans('Otp::message.code_message' , [ 'code' => $event->otp->code , 'shop_name' => config('core.shop_name') ])
        );
    }
}
