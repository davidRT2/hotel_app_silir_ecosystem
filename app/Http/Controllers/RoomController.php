<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    private $baseUrl = "localhost:8080/api/v1/";

    public function getRoom()
    {
        $client = new Client();
        $url = $this->baseUrl . "tipe";
        $url2 = $this->baseUrl . "kamar";

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
        $response2 = $client->request('GET', $url2, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        $responseBody2 = json_decode($response2->getBody(), true);
        $data2 = $responseBody2['data'];

        return view('admin.room', compact('data', 'data2'));
    }
}
