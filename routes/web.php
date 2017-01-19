<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::get('/welcome', function () {
    return view('welcome');
});


/*
Route::get('/test', function () {
    return view('test');
});


Route::get('/index', function () {
    return view('index');
});

Route::get('/about',function(){
    return view('about');
});

Route::get('malzemeler',function(){
    return view('envanter.malzemeler');
});
Route::get('yenimalzeme',function(){
    return view('envanter.yenimalzeme');
});

*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::resource('malzemeler', 'MalzemelerController');
Route::resource('hareketler', 'HareketController');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/{page}',function($page){
        if(View::exists($page))
            return view($page);
    });
});


