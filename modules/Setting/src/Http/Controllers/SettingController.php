<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Setting\Contracts\SettingRepositoryInterface;

class SettingController extends Controller
{
    private $settingRepo;
    public function __construct(SettingRepositoryInterface $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }
    public function index()
    {
        return view('Setting::index');
    }
}
