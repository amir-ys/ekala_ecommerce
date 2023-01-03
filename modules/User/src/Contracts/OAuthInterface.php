<?php

namespace Modules\User\Contracts;

interface OAuthInterface
{
    public function redirect();
    public function callback();
}
