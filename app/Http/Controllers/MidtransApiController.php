<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use GuzzleHttp\Client;
use SebastianBergmann\Environment\Console;

class MidtransApiController extends Controller
{
    //
    private $baseUrl = "https://422c-103-162-237-197.ngrok-free.app/api/v1/";
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
        $nama = explode(' ', $request->input('nama'));
        $firstName = $nama[0];
        $lastName = '';
        if (count($nama) > 1) {
            $firstName = implode(' ', array_slice($nama, 0, -1));
            $lastName = end($nama);
        }
        
        $index = $request->input('tipe');
        $kamar = $this->getDetail($index);
        // print_r($kamar);
        $durasi = $request->input('durasi');
        $nama_kamar = $kamar[0]['nama_tipe'];
        $harga_per_malam = $kamar[0]['harga_per_malam'];
        $gross_amount = ($durasi * $harga_per_malam);
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $gross_amount,
            ),
            'item_details' => array(
                [
                    'id' => $request->input('tipe'),
                    'price' => $harga_per_malam,
                    'quantity' => $durasi,
                    'name' => ' Hari '.$nama_kamar
                ]
            ),
            'customer_details' => array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => 'herepfc@gmail.com',
                'phone' => $request->input('nomor')
            ),
        );
        // self::$params = $params;

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
        // return view('admin.add', compact('snapToken'));
    }

    public function getDetail($id)
    {
        $client = new Client();
        $url = $this->baseUrl . 'tipe/' . $id; // Correct the URL here
        $response = $client->request('GET', $url, [
            'verify' => false, // Set it to true for valid SSL certificates
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        return $data;
    }

    public function payment_post(Request $request){
        return $request;
    }
}
