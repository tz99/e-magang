<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/laporan/laporanlogaktivitas', 'App\Modules\laporan\laporanlogaktivitas\Controllers\LaporanlogaktivitasController');
Route::GET('/show_pdf', 'App\Modules\laporan\laporanlogaktivitas\Controllers\LaporanlogaktivitasController@show_pdf');
});