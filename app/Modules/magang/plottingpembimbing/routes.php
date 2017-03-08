<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/magang/plottingpembimbing', 'App\Modules\magang\plottingpembimbing\Controllers\PlottingpembimbingController');

});