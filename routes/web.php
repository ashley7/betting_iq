<?php
use App\UserTag;
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
	$save_user_tag = new UserTag();
    $save_user_tag->tag = time();
    $save_user_tag->save();
    session(['tag'=>$save_user_tag->tag]);
    return view('welcome');
});
Auth::routes();

Route::resource('ticket','TicketController');
Route::resource('games','GameCodeController');
Route::resource('process_ticket','ProcessTicketsController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/testing_grids', 'HomeController@testing_grids')->name('testing_grids');
Route::post('/resize_photoes', 'TicketController@resize_photoes');
