<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use TypeError;

class RoomController extends Controller
{
    //
    private $baseUrl = "localhost:8080/api/v1/";

    public function index()
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

    public function add(Request $request)
    {
        $client = new Client();
        $this->validate($request, [
            'prefix' => 'required|string',
            'room-amount' => 'required|numeric|max:20',
            'room-type' => 'required',
        ]);
        $lastGeneratedNumber = 0;
        $roomPrefix = $request->input('prefix');
        $roomAmount = $request->input('room-amount');
        $roomType = $request->input('room-type');
        $getKamarUrl = $this->baseUrl . "kamar";
        $response = $client->request('GET', $getKamarUrl, [
            'verify' => false,
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $kamar = $responseBody['data'];
        foreach ($kamar as $data) {
            if (strpos(str_replace(range(0, 9), '', $data['id_kamar']), $roomPrefix) === 0) {
                $existingIds[] = $data['id_kamar'];
                $lastGeneratedNumber = max($lastGeneratedNumber, (int)substr($data['id_kamar'], -3));
            }
        }
        $generateIds = [];
        if ($roomAmount > 1) {
            for ($i = 0; $i < $roomAmount; $i++) {
                $number = str_pad($lastGeneratedNumber += 1, 3, '0', STR_PAD_LEFT);
                $generatedId = $roomPrefix . $number;
                $generateIds[] = ['id_kamar' => $generatedId, 'id_tipe' => $roomType];
            }
        } else {
            $generatedId = $roomPrefix . str_pad($lastGeneratedNumber+1, 3, '0', STR_PAD_LEFT);
            $generateIds[] = ['id_kamar' => $generatedId, 'id_tipe' => $roomType];
        }

        $url = $this->baseUrl . "kamar";

        // Mengirim data ke API menggunakan HTTP Client (Laravel Http)
        $response = Http::post($url, $generateIds);

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {
            // Berhasil mengirim data ke API
            // return response()->json(['status' => 'success', 'data' => $response->json()], 200);
            return Redirect::route('room-index');
        } else {
            // Gagal mengirim data ke API
            return response()->json(['status' => 'failed', 'message' => 'Failed to send data to API'], 500);
        }
    }
}
