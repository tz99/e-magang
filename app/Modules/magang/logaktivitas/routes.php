<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/magang/logaktivitas', 'App\Modules\magang\logaktivitas\Controllers\LogaktivitasController');

});