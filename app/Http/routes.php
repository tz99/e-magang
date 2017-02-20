<?php
use App\Modules\settings\configurations\Models\ConfigurationsModel;
use App\Modules\settings\permissionsmatrix\Models\PermissionsmatrixModel;
//use \Session, \Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //mainkan Portal Disini
    return view('home::login.index');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/login', function () {
        return view('home::login.index');
    });
    Route::get('/login', function () {
        return view('home::login.index');
    });
    Route::post('/login', array('as' => 'dologin', 'uses'=>'AuthController@postLogin'));
});
Route::group(['middleware' => 'auth'], function () {    
    Route::get('test_pdf', function(){
        $contents = view('home::dashboard.test_pdf');
        $response = \Response::make($contents);
        $response->header('Content-Type', 'application/pdf');
        return $response;        
    });    
    Route::get('test_excel', function(){
//        $contents = view('home::dashboard.test_pdf');
//        $response = \Response::make($contents);
//        $response->header('Content-Type', 'application/pdf');
//        return $response;        
        return view('home::dashboard.test_excel');
    });    
	Route::get('/profil', array('as' => 'logout', 'uses'=>'AuthController@getProfil'));
	Route::post('/profil', array('as' => 'logout', 'uses'=>'AuthController@postProfil'));
	Route::get('/pass', array('as' => 'logout', 'uses'=>'AuthController@getPass'));
	Route::post('/pass', array('as' => 'logout', 'uses'=>'AuthController@postPass'));
    
    Route::get('/dashboard', function () {
        return view('home::dashboard.index');
    });
//    Route::get('/auth/login', function () {
//        return redirect('/dashboard') ;
//    });
    Route::get('/login', function () {
        return redirect('/dashboard') ;
    });
});

Route::get('/logout', array('as' => 'logout', 'uses'=>'AuthController@getLogout'));
