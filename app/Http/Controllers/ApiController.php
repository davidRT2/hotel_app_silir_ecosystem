<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class ApiController extends Controller
{
    /**
     *Mendapatkan data daftar penginap 
     *
     */
    public function getDataPenginap()
    {
        $client = new Client();
        $url = "http://localhost:8080/api/v1/penginap/";

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return view('debug.detailKamar', compact('responseBody'));
    }

    public function getPenginapByID($id){
        $client = new Client();
        $url = "http://localhost:8080/api/v1/penginap/{$id}";
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
    
        $data = json_decode($response->getBody(), true);
        $data = $data['data'];

        return view('debug.byID', compact('data'));
    }

    public function getPenginapByName($name){
        $client = new Client();
        $url = "http://localhost:8080/api/v1/penginap/nama/{$name}";
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
    
        $data = json_decode($response->getBody(), true);
        $data = $data['data'];

        return view('debug.byName', compact('data'));
    }

    public function getDetailKamar($id)
    {
        $client = new Client();
        $url = "http://localhost:8080/api/v1/kamar/{$id}";
    
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
    
        $detailKamar = json_decode($response->getBody(), true);
        $data = $detailKamar['data'];
    
        return view('debug.beDebug', compact('data'));
    }


    
}
