<?php

use Illuminate\Http\Request;

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

Route::get('/home', function () {
    return view('home');
});

Route::get('/books', function() {
   return view('books');
});

Route::post('/books', function(Request $request) {

    $client = new GuzzleHttp\Client();

    if(isset($request['isbn'])) {

        if(strlen($request['isbn']) >0) {

            $res = $client->request('GET', 'https://www.googleapis.com/books/v1/volumes?q=isbn:$request["isbn"]', [
                'auth' => ['stojan.mitric.dev@gmail.com', 'stojanovasifra35']
            ]);

            echo $res->getStatusCode();
// "200"
            echo $res->getHeader('content-type');
// 'application/json; charset=utf8'
            echo $res->getBody();
// {"type":"User"...'

// Send an asynchronous request.

            /*$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
            $promise = $client->sendAsync($request)->then(function ($response) {
                echo 'I completed! ' . $response->getBody();
            });
            $promise->wait();*/

        } else {
            return redirect()->back();
        }

    } else {
        return redirect()->back();
    }

});
