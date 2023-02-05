<?php

namespace Modules\User\Services\EmailVerify;

use Modules\User\Models\User;

class EmailVerifyService
{
    private static string $prefix = 'user_verify_';
    private static $min = 100000;
    private static $max = 999999;

    public static function check(User $user, $requestCode)
    {
        $code = self::getCode($user->id);
        if ($requestCode != $code) {
            return false;
        }
        self::delete($user->id);

        return true;
    }

    public static function store($userId, $code, $time = null)
    {
        $time = $time ?? now()->addHour();

        cache()->put(self::$prefix . $userId, $code, $time);
    }

    public static function has($userId)
    {
        return \cache()->has(self::$prefix . $userId);
    }

    public static function generateCode(): int
    {
        return random_int(self::$min, self::$max);
    }

    private static function delete($userId)
    {
        return cache()->delete(self::$prefix . $userId);
    }

    private static function getCode($userId)
    {
        return cache()->get(self::$prefix . $userId);
    }
}
