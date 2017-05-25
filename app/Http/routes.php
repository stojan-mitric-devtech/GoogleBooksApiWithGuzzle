<?php

Route::group(['middleware' => ['web']], function() {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/books', [
        'as' => 'books',
        'middleware' => 'auth'
    ]);

});



?>