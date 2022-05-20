<?php

namespace Modules\AttributeGroup\Routes;

use Illuminate\Support\Facades\Route;
use Modules\AttributeGroup\Http\Controllers\AttributeGroupController;

Route::group([],function (){
   Route::resource('attribute-group' , AttributeGroupController::class)->names('panel.attributeGroups');
});
