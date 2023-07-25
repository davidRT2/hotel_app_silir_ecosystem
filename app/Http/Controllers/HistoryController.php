<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;

class HistoryController extends Controller
{
    //
    private $baseUrl = "localhost:8080/api/v1/";
    public function index()
    {
        $client = new Client();
        $url = $this->baseUrl . 'history';
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        $income = 0;
        foreach ($data as $entry) {
            if ($entry['status'] == 1) {
                $income += $entry['total_bayar'];
            }
        }
        return view('admin.history', compact('data', 'income'));
    }

    public function status(Request $request)
    {
        $id = $request->input('idBooking');
        $client = new Client();
        $url = $this->baseUrl . "history/status/" . $id;
        $url2 = $this->baseUrl . "penginap/status/" . $id;

        try {
            $response = $client->request('PUT', $url, [
                'verify' => false,
                'json' => [
                    'status' => 1,
                ],
            ]);
            $response = $client->request('PUT', $url2, [
                'verify' => false,
                'json' => [
                    'status' => 0,
                ],
            ]);

            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            if ($responseData['status'] === 'success') {
                return Redirect::route('admin.home')->with('succes', 'berhasil Checkout');
            } else {
            }
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
