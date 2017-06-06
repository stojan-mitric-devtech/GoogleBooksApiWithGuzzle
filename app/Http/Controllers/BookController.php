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

    private $guzzleClient;

    public function __construct()
    {
        $this->guzzleClient = new Client(['base_uri' => 'https://www.googleapis.com/books/v1/volumes',
            'verify' => "C:/wamp64/bin/php/php5.6.25/extras/ssl/cacert.pem" ]);

        $this->guzzleClient->getConfig('config/curl/' . CURLOPT_SSL_VERIFYPEER, false);
    }


    public function searchByIsbn(Request $request)
    {
        if (isset($request['isbn'])) {

            $this->validate($request, [
                'isbn' => 'required|min:10|max:13'
            ]);

            $isbn = $request['isbn'];

            if (strlen($isbn) > 0) {

                $response = $this->guzzleClient->request('GET', '?q=isbn:' . $isbn);

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

                echo "Book authors are: " . @implode(",", $data['items'][0]["volumeInfo"]["authors"]);

                echo '<br>';

                echo "Pagecount = " . $data['items'][0]['volumeInfo']['pageCount'];
            }
        } else {
            return redirect()->back();
        }
    }

    public function searchByName(Request $request)
    {
        if (isset($request['bookName'])) {

            $this->validate($request, [
                'bookName' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/'
            ]);

            $bookName = $request['bookName'];

            if (strlen($bookName) > 0) {


                $response = $this->guzzleClient->request('GET', '?q=intitle:' . $bookName);

                $result = $response->getBody();

                echo $response->getStatusCode();

                echo '<br>';
                echo '<br>';

                echo $result;
            }
        } else {
            return redirect()->back();
        }
    }

}