<?php

namespace Modules\Notification\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Modules\Notification\Services\Providers\Email\DefaultEmailService;
use Modules\Notification\Services\Providers\Sms\BaseSmsProvider;
use Modules\Notification\Services\Providers\Sms\TestModeSmsProvider;
use Modules\User\Contracts\UserRepositoryInterface;
use function PHPUnit\Framework\throwException;

final class Notification extends BaseSmsProvider
{
    public function __call($method, $parameters)
    {
        $actionMethod = str($method)->substr(4)->start('send')->toString();

        if (!method_exists($this, $actionMethod)) {
            throw new \Exception(sprintf("Call to undefined method Modules\Notification\Services\Notification::%s()", $method));
        }

        $this->$actionMethod(...$parameters);
    }

    protected function sendSms(string $phone_number, string $text): void
    {
        if ($this->isRunningInTestingMode()) {
            resolve(TestModeSmsProvider::class);
        } else {
            $smsProviderClass = $this->getDefaultSmsProviderClass();
            $smsProviderObj = (new $smsProviderClass())->send($phone_number, $text);
        }
    }

    public function sendEmail($email, $mailable)
    {
        $user = $this->checkEmailExists($email);

        resolve(DefaultEmailService::class)->send($user , $mailable);
    }

    protected function isRunningInTestingMode(): bool
    {
        return config('notification.sms.test_mode');
    }

    private function checkEmailExists(string $email)
    {
        $user = resolve(UserRepositoryInterface::class)->findByEmail($email);
        if (!$user) {
            throw new \Exception(sprintf("User with email address %s does not exist", $email));
        }
        return $user;
    }

}
