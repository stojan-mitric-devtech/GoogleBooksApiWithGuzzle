<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

    $client = new Client(['base_uri' => 'https://www.googleapis.com/books/v1/',
        'verify' => "C:/wamp64/bin/php/php5.6.25/extras/ssl/cacert.pem" ]);

    $client->getConfig('config/curl/' . CURLOPT_SSL_VERIFYPEER, false);

    if(isset($request['isbn']) || isset($request['bookName'])) {

        if(strlen($request['isbn']) >0) {

            $response = $client->request('GET','volumes?q=isbn:' . $request['isbn']);

            $result = (string)$response->getBody();

            echo $result;


        } else if(strlen($request['bookName']) >0){

            /*$response = $client->request('GET', $request["bookName"]);

            echo $response->getStatusCode();
            echo $response->getHeader('content-type');
            echo $response->getBody();*/

        }else {
            return redirect()->back();
        }

    } else {
        return redirect()->back();
    }

});
