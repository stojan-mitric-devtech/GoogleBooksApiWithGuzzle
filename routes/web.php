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

    $client = new Client(['base_uri' => 'https://www.googleapis.com/books/v1/volumes',
        'verify' => "C:/wamp64/bin/php/php5.6.25/extras/ssl/cacert.pem" ]);

    $client->getConfig('config/curl/' . CURLOPT_SSL_VERIFYPEER, false);

    if(isset($request['isbn']) || isset($request['bookName'])) {

        $isbn = $request['isbn'];
        $bookName = $request['bookName'];

        if(strlen($isbn) > 0) {

            $response = $client->request('GET','?q=isbn:' . $isbn);

            $result = $response->getBody();

            echo $response->getStatusCode();

            echo '<br>';
            echo '<br>';

            echo $result;

            echo '<br>';
            echo '<br>';

            $data = json_decode($result, true);

            echo "Book name is: " . $data['items'][0]["volumeInfo"]["title"];

            echo '<br>';

            echo "Book authors are: " . @implode(",",  $data['items'][0]["volumeInfo"]["authors"]);

            echo '<br>';

            echo "Pagecount = " . $data['items'][0]['volumeInfo']['pageCount'];


        } else if(strlen($bookName) > 0){

            $response = $client->request('GET', '?q=intitle:'. $bookName);

            $result = $response->getBody();

            echo $response->getStatusCode();

            echo '<br>';
            echo '<br>';

            echo $result;


        }else {
            return redirect()->back();
        }

    } else {
        return redirect()->back();
    }

});
