<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/laporan/laporansiswamagang', 'App\Modules\laporan\laporansiswamagang\Controllers\LaporansiswamagangController');
Route::GET('/cetak_pdf', 'App\Modules\laporan\laporansiswamagang\Controllers\LaporansiswamagangController@cetak_pdf');

});