<?php

Route::group(['middleware' => ['web']], function() {

    Route::get('/home', function () {
        return view('home');
    });

/*
    Route::get('/books', function () {
        return view('books');
    });

    Route::post('/books', [
        'uses' => 'BookController@postBook',
        'as' => 'books'
    ]);
*/



});



?>