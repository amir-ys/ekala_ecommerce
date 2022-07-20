<?php

namespace Modules\Setting\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\SettingController;

Route::group([], function () {
    Route::get('settings' , [ SettingController::class , 'index' ])->name('panel.settings.index');
    Route::get('settings/about-us' , [ SettingController::class , 'aboutPage' ])->name('panel.settings.about.page');
    Route::post('settings/about' , [ SettingController::class , 'storeAbout' ])->name('panel.settings.about.store');
    Route::get('settings/about/image/{name}/show' , [ SettingController::class , 'showAboutImage' ])->name('panel.settings.aboutImage.show');
});

