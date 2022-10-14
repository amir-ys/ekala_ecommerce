<?php

namespace Modules\Setting\Repositories;

use Modules\Core\Repositories\BaseRepository;
use Modules\Setting\Contracts\SettingRepositoryInterface;
use Modules\Setting\Models\Setting;

class SettingRepo extends BaseRepository implements SettingRepositoryInterface
{
    protected string $model = Setting::class;

    public function getAbout()
    {
        return $this->query->where('name', Setting::SETTING_ABOUT_US)->first();
    }

    public function storeAbout($data)
    {
        $this->query->updateOrCreate(
            [
                'name' => Setting::SETTING_ABOUT_US
            ],
            [
                'json' => [
                    'title' => $data['title'] ?? null,
                    'photo' => $data['photo_uploaded'],
                    'description' => $data['description'] ?? null,
                ]
            ]);
    }

    public function getContact()
    {
        return $this->query->where('name', Setting::SETTING_CONTACT_US)->first();
    }

    public function storeContact($data)
    {
        $this->query->updateOrCreate(
            [
                'name' => Setting::SETTING_CONTACT_US
            ],
            [
                'json' => [
                    'email' => $data['email'] ?? null,
                    'phone_number_1' => $data['phone_number_1'],
                    'phone_number_2' => $data['phone_number_2'],
                    'shop_address' => $data['shop_address'] ?? null,
                ]
            ]);
    }

    public function storeSiteInfo($data)
    {
        $this->saveInSetting(Setting::SETTING_SHOP_NAME, $data['shop_name']);
        $this->saveInSetting(Setting::SETTING_SHOP_FOOTER, $data['shop_footer']);
        $this->saveInSetting(Setting::SETTING_SHOP_FOOTER_CONTACT, $data['shop_footer_contact']);
    }

    private function saveInSetting($name, $value)
    {
        $this->query->updateOrCreate(
            [
                'name' => $name
            ],
            [
                'value' => $value
            ]);
    }

    public function getItem($value)
    {
        return $this->query->where('name', $value)->first();
    }

    public function storeSocialMedia($data)
    {
        $this->query->updateOrCreate(
            [
                'name' => Setting::SETTING_SOCIAL_MEDIA
            ],
            [
                'json' => [
                    Setting::SETTING_SOCIAL_FACEBOOK => $data['facebook'],
                    Setting::SETTING_SOCIAL_INSTAGRAM => $data['instagram'],
                    Setting::SETTING_SOCIAL_TWITTER => $data['twitter'],
                    Setting::SETTING_SOCIAL_LINKEDIN => $data['linkedin'],
                    Setting::SETTING_SOCIAL_YOUTUBE => $data['youtube'],
                ]
            ]);
    }
}
