<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    private $baseUrl = "https://4ff5-103-162-237-197.ngrok-free.app/api/v1/";

    public function getDataPenginap()
    {
        $client = new Client();
        $url = $this->baseUrl . "penginap/";

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        return view('debug.detailKamar', compact('responseBody'));
    }

    public function getTipe()
    {
        $client = new Client();
        $url = $this->baseUrl . "tipe";

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];

        return view('reservation', compact('data'));
    }

    public function getPenginapByID($id)
    {
        $client = new Client();
        $url = $this->baseUrl . "penginap/{$id}";

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $data = json_decode($response->getBody(), true);
        $data = $data['data'];

        return view('debug.byID', compact('data'));
    }

    public function getPenginapByName($name)
    {
        $client = new Client();
        $url = $this->baseUrl . "penginap/nama/{$name}";

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
        $url = $this->baseUrl . "kamar/{$id}";

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $detailKamar = json_decode($response->getBody(), true);
        $data = $detailKamar['data'];

        return view('detail-kamar', compact('data'));
    }
    //tambahan method checkout febri
    public function checkout(Request $request)
    {
        $nama = $request->input('nama');
        $nomorTelepon = $request->input('nomor_telepon');
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $roomType = $request->input('room_type');
        $kodeTiket = $request->input('kode_tiket');
        $kodeParkir = $request->input('kode_parkir');

        // Lakukan proses selanjutnya, seperti menyimpan data ke database atau mengirim email konfirmasi

        return view('checkout', compact('nama', 'nomorTelepon', 'checkIn', 'checkOut', 'roomType', 'kodeTiket', 'kodeParkir'));
    }
}
