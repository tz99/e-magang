<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/master/supervisor', 'App\Modules\master\supervisor\Controllers\SupervisorController');

});