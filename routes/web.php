<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');
// Ticket Controller -- namespace eklenebilir.
Route::resource('/tickets', 'TicketController')->middleware('auth');
Route::post('/complete-ticket', 'CompleteTicketController');
Route::post('/comments/store', 'CommentController@store')->name('comments.store');
