<?php

namespace Modules\User\Http\Controllers\Auth\OAuth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Modules\User\Contracts\OAuthInterface;
use Modules\User\Contracts\UserRepositoryInterface;

class OAuthByGoogleController extends Controller implements OAuthInterface
{
    protected string $driver = 'google';

    public function redirect()
    {
        return Socialite::driver($this->driver)->stateless()->redirect();
    }

    public function callback()
    {
        $googleInfo = Socialite::driver($this->driver)->stateless()->user();

        $user = resolve(UserRepositoryInterface::class)->findByEmail($googleInfo->email);
        if (!$user) {
            $user = resolve(UserRepositoryInterface::class)->storeWithSpecifiedData([
                'first_name' => $googleInfo->user['given_name'],
                'last_name' => $googleInfo->user['family_name'],
                'email' => $googleInfo->email,
                'password' => bcrypt(Str::random(8)),
                'email_verified_at' => now(),
            ]);

            event(new Registered($user));

        }
        Auth::login($user);

        return redirect()->intended();
    }
}
