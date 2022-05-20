<?php
namespace Modules\Attribute\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Attribute\Http\Controllers\AttributeController;
use Modules\Attribute\Http\Controllers\AttributeValueController;

Route::group([] , function (){
   Route::resource('attributes' , AttributeController::class)->names('panel.attributes');
   Route::get('attributes/{attribute}/value' , [AttributeValueController::class , 'saveValueIndex'])->name('panel.attributes.value.index');
   Route::post('attributes/{attribute}/value/save' , [AttributeValueController::class , 'saveValue'])->name('panel.attributes.value.save');
   Route::delete('attributes/{attribute}/value/delete' , [AttributeValueController::class , 'deleteValue'])->name('panel.attributes.value.delete');
});

