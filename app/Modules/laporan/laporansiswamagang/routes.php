<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/laporan/laporansiswamagang', 'App\Modules\laporan\laporansiswamagang\Controllers\LaporansiswamagangController');

});