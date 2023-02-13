<?php

namespace Modules\Otp\Services;

use Modules\Otp\Contracts\OtpRepositoryInterface;
use Modules\Otp\Models\Otp;

class OtpService
{
    protected $otpRepo;
    protected $phone_number;
    protected $otp;

    public function __construct(OtpRepositoryInterface $otpRepo)
    {
        $this->otpRepo = $otpRepo;
    }

    public function requestOtp($phone_number): Otp
    {
        $this->phone_number = $phone_number;

        $this->processOtpRequest();

        return $this->otp;
    }

    private function processOtpRequest(): void
    {
        $otp = $this->otpRepo->findByPhoneNumber($this->phone_number);

        if ($otp) {
            $this->checkCodeExpiration($otp);
        } else {
            $this->generateNewCode();
        }
    }

    private function checkCodeExpiration($otp): void
    {
        $expire_date = $otp->created_at->timestamp + config('otp.expiration_time');
        $now = now()->timestamp;

        $expire_date < $now ?
            $this->generateNewCode(true) :
            $this->otp = $otp;
    }

    private function generateNewCode($withDelete = false): void
    {
        if ($withDelete) {
            $this->deletePreviousCOde();
        }

        $otp = $this->generateRandomUniqueCode();

        $this->otp = $this->createNewOtp($otp);
        ;
    }

    private function deletePreviousCode(): void
    {
        $this->otpRepo->destroyByPhoneNumber($this->phone_number);
    }

    private function generateRandomUniqueCode(): int
    {
        $randomCode = random_int(100000, 999999);

        //check code has unique
        $otp = $this->otpRepo->findByCode($randomCode);
        if ($otp) {
            $this->generateRandomUniqueCode();
        }
        return $randomCode;
    }

    private function createNewOtp($otp)
    {
       return $this->otpRepo->store([
            'phone_number' => $this->phone_number,
            'code' => $otp,
        ]);
    }
}
