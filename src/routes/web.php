<?php

Route::group(['namespace' => 'duncanrmorris\quotes\Http\Controllers'], function()
{
    Route::group(['middleware' => ['web', 'auth']], function(){
        
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
   

    });
});