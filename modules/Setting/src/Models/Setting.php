<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Setting\Database\Factories\SettingFactory;

class Setting extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];
    protected $casts = [
      'json' => 'json'
    ];

    const SETTING_ABOUT_US = 'about-us';
    const SETTING_CONTACT_US = 'contact-us';
    const SETTING_SHOP_NAME = 'shop-name';
    const SETTING_SHOP_FOOTER = 'shop-footer';
    const SETTING_SHOP_FOOTER_CONTACT= 'footer-contact';

    const SETTING_SOCIAL_MEDIA = 'social-media';
    const SETTING_SOCIAL_FACEBOOK = 'facebook' ;
    const SETTING_SOCIAL_TWITTER = 'twitter' ;
    const SETTING_SOCIAL_YOUTUBE = 'youtube' ;
    const SETTING_SOCIAL_INSTAGRAM = 'instagram' ;
    const SETTING_SOCIAL_LINKEDIN = 'linkedin' ;

    public static function getAboutUsDir()
    {
        return 'settings' . DIRECTORY_SEPARATOR . 'about-us';
    }

    public static function factory(): SettingFactory
    {
        return new SettingFactory();
    }

    public function imagePath(): ?string
    {
        return  $this->json['photo']['default'] ?  route('panel.settings.aboutImage.show' , [ 'name' => $this->json['photo']['default']]) : null;
    }
}
