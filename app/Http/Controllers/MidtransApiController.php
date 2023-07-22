<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use GuzzleHttp\Client;

class MidtransApiController extends Controller
{
    //
    private $baseUrl = "localhost:8080/api/v1/";
    public function index(){
        $client = new Client();
        $url = $this->baseUrl . 'tipe';
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        return view('admin.add', compact('data'));
    }

    public function booking(Request $request)
    {
        Config::$serverKey = 'SB-Mid-server-MAmDDEAqe8qTzseqc2RG13Mb';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set3DStransaction for credit card to true
        Config::$is3ds = true;
        $nama = explode(' ',$request->input('nama'));
        $firstName = $nama[0];
        $lastName = $nama[1];
        if(count($nama) > 2){
            $firstName = $nama[0] .' '. $nama[1];
            $lastName = $nama[2];
        }
        $index = $request->input('namaKamar');
        $kamar = $this->getDetail($index);
        // print_r($kamar);
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $kamar[0]['harga_per_malam'],
            ),
            'item_details' => array(
                [
                    'id' => 'A1',
                    'price' => $kamar[0]['harga_per_malam'],
                    'quantity' => 1,
                    'name' => $kamar[0]['nama_tipe']
                ]
            ),
            'customer_details' => array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => 'example@gmail.com',
                'phone' => $request->input('nomor'),
            ),
        );

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
        // return view('admin.add', compact('snapToken'));
    }

    public function getDetail($id)
    {
        $client = new Client();
        $url = $this->baseUrl . 'tipe/' . $id ; // Correct the URL here
        $response = $client->request('GET', $url, [
            'verify' => false, // Set it to true for valid SSL certificates
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        return $data;
    }

}
