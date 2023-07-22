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
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 5000,
            ),
            'item_details' => array(
                [
                    'id' => 'A1',
                    'price' => '5000',
                    'quantity' => 1,
                    'name' => 'Apel'
                ]
            ),
            'customer_details' => array(
                'first_name' => $request->input('nama'),
                'last_name' => 'asds',
                'email' => 'example@gmail.com',
                'phone' => '09709999809',
            ),
        );

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
        // return view('admin.add', compact('snapToken'));
    }
}
