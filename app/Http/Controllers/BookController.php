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
        $this->guzzleClient = new Client(['base_uri' => env('GUZZLE_URL'), 'verify' => env('GUZZLE_SSL_LOCAL')]);
        $this->guzzleClient->getConfig('config/curl/' . CURLOPT_SSL_VERIFYPEER, false);
    }


    public function searchByIsbn(Request $request)
    {
            $this->validate($request, [
                'bookIsbn' => 'required|min:10|max:13'
            ]);

            $isbn = $request['bookIsbn'];

            $response = $this->guzzleClient->request('GET', '?q=isbn:' . $isbn);

            header('Content-Type: application/json');

            $resp = $response->getBody();

            $result = (string) $resp;

            echo json_encode($result, JSON_PRETTY_PRINT);
    }



    public function searchByName(Request $request)
    {

            $this->validate($request, [
                'bookName' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/'
            ]);

            $bookName = $request['bookName'];

            $response = $this->guzzleClient->request('GET', '?q=intitle:' . $bookName);

            header('Content-Type: application/json');

            $resp = $response->getBody();

            $result = (string) $resp;

            echo json_encode($result, JSON_PRETTY_PRINT);

    }

}