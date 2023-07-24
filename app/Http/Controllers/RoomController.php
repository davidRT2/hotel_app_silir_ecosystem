<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class RoomController extends Controller
{
    //
    private $baseUrl = "https://422c-103-162-237-197.ngrok-free.app/api/v1/";

    public function index(Request $request)
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
        $jumlahKamar = count($responseBody2['data']);
        $data2 = $this->paginate($responseBody2['data'], 5, null, [], $request->fullUrl());
        return view('admin.room', compact('data', 'data2', 'jumlahKamar'));
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [], $currentUrl)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        // Dapatkan URL saat ini dan hapus parameter 'page' dari URL
        $currentUrl = strtok($currentUrl, '?');

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => $currentUrl, // Menggunakan URL saat ini tanpa parameter 'page'
            // tambahkan opsi-opsi lainnya sesuai kebutuhan
        ]);
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
            $generatedId = $roomPrefix . str_pad($lastGeneratedNumber + 1, 3, '0', STR_PAD_LEFT);
            $generateIds[] = ['id_kamar' => $generatedId, 'id_tipe' => $roomType];
        }

        $url = $this->baseUrl . "kamar";

        // Mengirim data ke API menggunakan HTTP Client (Laravel Http)
        $response = Http::post($url, $generateIds);

        // Memeriksa apakah permintaan berhasil
        if ($response->successful()) {
            // Berhasil mengirim data ke API
            // return response()->json(['status' => 'success', 'data' => $response->json()], 200);
            return Redirect::route('room-index')->with('success', 'Kamar Berhasil Ditambahkan');
        } else {
            // Gagal mengirim data ke API
            return Redirect::route('room-index')->with('eror', '500 Failed to send data to API');
        }
    }
}
