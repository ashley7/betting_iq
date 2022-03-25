<?php
ini_set('memory_limit','512M');
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
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::resource('ticket','TicketController');
	Route::resource('games','GameCodeController');
	Route::resource('process_ticket','ProcessTicketsController');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/testing_grids', 'HomeController@testing_grids')->name('testing_grids');
	Route::post('/resize_photoes', 'TicketController@resize_photoes');
	Route::get('/failed_payments','HomeController@failed_payments');
	Route::get('/payments_made_well','HomeController@payments_made_well');
	Route::get('/ticket_details/{tad_id}','ProcessTicketsController@randomAccessTickets');
	Route::resource('bet','BetController');

});
