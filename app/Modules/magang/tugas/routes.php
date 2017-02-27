<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/magang/tugas', 'App\Modules\magang\tugas\Controllers\TugasController');

});