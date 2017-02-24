<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/master/project', 'App\Modules\master\project\Controllers\ProjectController');

});