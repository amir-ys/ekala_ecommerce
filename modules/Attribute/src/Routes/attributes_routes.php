<?php
namespace Modules\Attribute\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Attribute\Http\Controllers\AttributeController;

Route::group(['prefix' => 'panel'] , function (){
   Route::resource('attributes' , AttributeController::class)
       ->names('panel.attributes')
       ->except('show');
});

