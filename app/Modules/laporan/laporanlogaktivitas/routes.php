<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/laporan/laporanlogaktivitas', 'App\Modules\laporan\laporanlogaktivitas\Controllers\LaporanlogaktivitasController');

});