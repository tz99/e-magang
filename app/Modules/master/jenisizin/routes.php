<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/master/jenisizin', 'App\Modules\master\jenisizin\Controllers\JenisizinController');

});