<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
    // $this->redirectTo = route('login');
});

// Route::get('/master', function(){
//     return view('adminlte.master');
// });

// Route::get('/master', function(){
//     return view('adminlte.master');
// });


// Route::get('/master', function(){
//     return view('adminlte.master');
// });

// Route::get('/items', function(){
//     return view('items.index');
// });

// Route::get('/items/create', function(){
//     return view('items.create');
// });


// Route::get('/perusahaan/create', 'PerusahaanController@create');
// Route::post('/perusahaan', 'PerusahaanController@store');
// Route::get('/perusahaan', 'PerusahaanController@index');
// Route::get('/perusahaan/{id}', 'PerusahaanController@show');
// Route::get('/perusahaan/{id}/edit', 'PerusahaanController@edit');
// Route::put('/perusahaan/{id}', 'PerusahaanController@update');
// Route::delete('/perusahaan/{id}', 'PerusahaanController@destroy');

// Route::resource('perusahaan', 'PerusahaanController')->middleware('auth');

Route::resource('perusahaan', 'PerusahaanController');
Route::resource('jenismesin', 'JenisMesinController');
Route::resource('users', 'UserController');
Auth::routes();

Route::get('/index', function(){
    return view('index');
});

Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
