<?php

namespace Modules\Setting\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\AboutController;
use Modules\Setting\Http\Controllers\ContactController;
use Modules\Setting\Http\Controllers\FaqController;
use Modules\Setting\Http\Controllers\SettingController;

Route::post('settings/contact-us/save-message' , [ ContactController::class , 'saveContactMessage' ])->name('panel.settings.contact.saveContactMessage');

Route::group([ 'middleware' => 'auth'], function () {
    Route::get('settings' , [ SettingController::class , 'index' ])->name('panel.settings.index');

    //site settings
    Route::post('settings/site-info' , [ SettingController::class , 'siteInfoStore' ])->name('panel.settings.siteInfo.store');
    Route::post('settings/social-media' , [ SettingController::class , 'socialMediaStore' ])->name('panel.settings.socialMedia.store');


    //about-us
    Route::get('settings/about-us' , [ AboutController::class , 'aboutPage' ])->name('panel.settings.about.page');
    Route::post('settings/about' , [ AboutController::class , 'storeAbout' ])->name('panel.settings.about.store');
    Route::get('settings/about/image/{name}/show' , [ AboutController::class , 'showAboutImage' ])->name('panel.settings.aboutImage.show');

    //contact-us
    Route::get('settings/contact-us' , [ ContactController::class , 'index' ])->name('panel.settings.contact.index');
    Route::get('settings/contact-us/{id}/show' , [ ContactController::class , 'show' ])->name('panel.settings.contact.show');
    Route::get('settings/contact-us/save' , [ ContactController::class , 'saveInfoPage' ])->name('panel.settings.contact.save.page');
    Route::post('settings/contact-us/save' , [ ContactController::class , 'saveInfo' ])->name('panel.settings.contact.save');

    //faqs
    Route::get('settings/faqs' , [ FaqController::class , 'index' ])->name('panel.settings.faqs.index');
    Route::get('settings/faqs/create' , [ FaqController::class , 'create' ])->name('panel.settings.faqs.create');
    Route::post('settings/faqs/store' , [ FaqController::class , 'store' ])->name('panel.settings.faqs.store');
    Route::get('settings/faqs/{id}/edit' , [ FaqController::class , 'edit' ])->name('panel.settings.faqs.edit');
    Route::patch('settings/faqs/{id}/update' , [ FaqController::class , 'update' ])->name('panel.settings.faqs.update');
    Route::delete('settings/faqs/{id}/destroy' , [ FaqController::class , 'destroy' ])->name('panel.settings.faqs.destroy');

});

