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
Route::any('/mastermesin/data', 'MasterMesinController@data');
Route::post('/mastermesin/print', 'MasterMesinController@print');
Route::post('/mastermesin/excel', 'MasterMesinController@exportexcel');
Route::get('/mastermesin/{idvendor}/{idjm}/barcode', 'MasterMesinController@barcode');
Route::get('/mastermesin/hapus/{id}','MasterMesinController@hapus');
Route::resource('mastermesin', 'MasterMesinController');
Route::post('/users/print', 'UserController@print')->name('printuser');
Route::get('/users/hapus/{id}','UserController@hapus');
Route::post('/users/reset/{id}','UserController@reset');
Route::get('/users/excel', 'UserController@exportexcel');
Route::get('/users/printdata', 'UserController@printdata');
Route::resource('perusahaan', 'PerusahaanController');
Route::get('/jenismesin/printdata', 'JenisMesinController@printdata');
Route::get('/jenismesin/excel', 'JenisMesinController@exportexcel');
Route::get('/jenismesin/number', 'JenisMesinController@number');
Route::get('/jenismesin/hapus/{id}','JenisMesinController@hapus');
Route::resource('jenismesin', 'JenisMesinController');
Route::get('/merkmesin/printdata', 'MerkMesinController@printdata');
Route::get('/merkmesin/excel', 'MerkMesinController@exportexcel');
Route::get('/merkmesin/hapus/{id}','MerkMesinController@hapus');
Route::resource('merkmesin', 'MerkMesinController');
Route::get('/vendors/printdata', 'VendorController@printdata');
Route::get('/vendors/hapus/{id}','VendorController@hapus');
Route::get('/vendors/excel', 'VendorController@exportexcel');
Route::get('/vendors/number', 'VendorController@number');
Route::resource('vendors', 'VendorController');


Route::resource('users', 'UserController');

Auth::routes();

Route::get('/index', function(){
    return view('index');
});

Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
