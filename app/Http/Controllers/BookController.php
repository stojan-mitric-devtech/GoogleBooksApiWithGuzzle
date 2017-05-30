<?php
/**
 * Created by PhpStorm.
 * User: stojan.mitric
 * Date: 5/25/2017
 * Time: 2:50 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BookController extends Controller {

    public function postBook(Request $request)
    {
        if(isset($request['isbn'])) {

            $this->validate($request, [
                'isbn' => 'required|min:10|max:13'
            ]);

        } else if(isset($request['bookName'])) {

            $this->validate($request, [
                'bookName' => 'regex:/(^[A-Za-z0-9 ]+$)+/'
            ]);

        }

        /*
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
        */

    }

}