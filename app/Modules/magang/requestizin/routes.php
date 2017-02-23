<?php

Route::group(['middleware' => 'auth'], function(){

Route::controller('/magang/requestizin', 'App\Modules\magang\requestizin\Controllers\RequestizinController');

});