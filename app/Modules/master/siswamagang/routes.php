<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/master/siswamagang', 'App\Modules\master\siswamagang\Controllers\SiswamagangController');

});