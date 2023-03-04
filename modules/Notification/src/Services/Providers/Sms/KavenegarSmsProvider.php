<?php

namespace Modules\Notification\Services\Providers\Sms;

use Kavenegar\KavenegarApi;
use Modules\Notification\Services\Providers\Sms\Contracts\SmsProviderContract;

class KavenegarSmsProvider extends BaseSmsProvider implements SmsProviderContract
{
    public function send($phone_number, $text)
    {
        try {
            $api = new KavenegarApi($this->getApiKey());
            $sender = 1000596446 ;
            $message = $text;
            $receptor = $phone_number;
            $result = $api->Send($sender, $receptor, $message);
            if ($result) {
                foreach ($result as $r) {
                    echo "messageid = $r->messageid";
                    echo "message = $r->message";
                    echo "status = $r->status";
                    echo "statustext = $r->statustext";
                    echo "sender = $r->sender";
                    echo "receptor = $r->receptor";
                    echo "date = $r->date";
                    echo "cost = $r->cost";
                }
            }
        } catch (\Kavenegar\Exceptions\ApiException $e) {
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            echo $e->errorMessage();
        } catch (\Kavenegar\Exceptions\HttpException $e) {
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
    }
}
