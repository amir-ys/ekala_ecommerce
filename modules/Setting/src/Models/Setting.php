<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Database\Factories\SettingFactory;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
      'json' => 'json'
    ];

    const SETTING_ABOUT_US = 'about-us';

    public static function getAboutUsDir()
    {
        return 'settings' . DIRECTORY_SEPARATOR . 'about-us';
    }

    public static function factory(): SettingFactory
    {
        return new SettingFactory();
    }

    public function imagePath($name): string
    {
        return route('panel.settings.aboutImage.show' , [ 'name' => $name]);
    }
}
