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

 #### QUOTES MODUEL ####
 Route::get('quotes', 'QuotesController@index')->name('quotes');
 Route::get('quotes/new', 'QuotesController@create')->name('quotes.new');
 Route::get('quotes/edit/{id}', 'QuotesController@edit')->name('quotes.edit');
 Route::put('quotes/update/{id}', 'QuotesController@update')->name('quotes.update');
 Route::get('quotes/view/{id}', 'QuotesController@show')->name('quotes.view');
 Route::put('quotes/crm-del/{id}', 'QuotesController@destroy')->name('quotes.del');
 Route::get('quotes/download/{id}','QuotesController@downloadPDF')->name('quotes.download');
 ### QUOTES LINES ###
 Route::put('quotes/ln-update/{id}/{iid}', 'QuotesLinesController@update')->name('quotes.ln.update');
 Route::get('quotes/ln-net/{id}', 'QuotesLinesController@create')->name('quotes.ln.new');
 Route::get('quotes/ln-del/{id}', 'QuotesLinesController@destroy')->name('quotes.ln.del');
