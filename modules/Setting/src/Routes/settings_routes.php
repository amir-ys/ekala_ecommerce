<?php

namespace Modules\Setting\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\AboutController;
use Modules\Setting\Http\Controllers\ContactController;
use Modules\Setting\Http\Controllers\SettingController;

Route::group([], function () {
    Route::get('settings' , [ SettingController::class , 'index' ])->name('panel.settings.index');

    //about-us
    Route::get('settings/about-us' , [ AboutController::class , 'aboutPage' ])->name('panel.settings.about.page');
    Route::post('settings/about' , [ AboutController::class , 'storeAbout' ])->name('panel.settings.about.store');
    Route::get('settings/about/image/{name}/show' , [ AboutController::class , 'showAboutImage' ])->name('panel.settings.aboutImage.show');

    //contact-us
    Route::get('settings/contact-us' , [ ContactController::class , 'index' ])->name('panel.settings.contact.index');
    Route::get('settings/contact-us/save' , [ ContactController::class , 'savePage' ])->name('panel.settings.contact.save.page');
    Route::post('settings/contact-us/save' , [ ContactController::class , 'save' ])->name('panel.settings.contact.save');
});

