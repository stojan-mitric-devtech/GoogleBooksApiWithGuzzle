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
use App\Providers\StojansResponse;

class BookController extends Controller {

    private $guzzleClient;
    private $stojansResponse;

    public function __construct()
    {
        $this->guzzleClient = new Client(['base_uri' => env('GUZZLE_URL')]);

        $this->stojansResponse = new StojansResponse();
    }


    public function searchByIsbn(Request $request)
    {
            $this->validate($request, [
                'bookIsbn' => 'required|min:10|max:13'
            ]);

            $isbn = $request['bookIsbn'];

            $response = $this->guzzleClient->request('GET', '?q=isbn:' . $isbn);

            $statusCode = $response->getStatusCode();

            $resp = $response->getBody();

            $result = (string) $resp;

            if($statusCode != 400 || $statusCode != 500) {
                $this->stojansResponse->onSuccess($result);
            } else {
                $this->stojansResponse->onFailure($statusCode);
            }

    }



    public function searchByName(Request $request)
    {

            $this->validate($request, [
                'bookName' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/'
            ]);

            $bookName = $request['bookName'];

            $response = $this->guzzleClient->request('GET', '?q=intitle:' . $bookName);

            $statusCode = $response->getStatusCode();

            $resp = $response->getBody();

            $result = (string) $resp;

            if($statusCode != 400 || $statusCode != 500) {
                $this->stojansResponse->onSuccess($result);
            } else {
                $this->stojansResponse->onFailure($statusCode);
            }

    }

}