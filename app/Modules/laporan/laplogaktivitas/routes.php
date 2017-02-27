<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/laporan/laplogaktivitas', 'App\Modules\laporan\laplogaktivitas\Controllers\LaplogaktivitasController');
Route::get('laporan-laplogaktivitas-search', 'App\Modules\laporan\laplogaktivitas\Controllers\LaplogaktivitasController@getSearch');

});