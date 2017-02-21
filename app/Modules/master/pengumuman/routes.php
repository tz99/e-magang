<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/master/pengumuman', 'App\Modules\master\pengumuman\Controllers\PengumumanController');

});