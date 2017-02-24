<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/laporan/lap.logaktivitas', 'App\Modules\laporan\lap.logaktivitas\Controllers\Lap.logaktivitasController');

});