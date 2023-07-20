<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    private $baseUrl = "localhost:8080/api/v1/";

    public function getDataPenginap()
    {
        $client = new Client();
        $url = $this->baseUrl . "penginap/";

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $urlKamar = $this->baseUrl . "kamar/";

        $responKamar = $client->request('GET', $urlKamar, [
            'verify' => false,
        ]);
        $responKamar = json_decode($responKamar->getBody(), true);
        $dataKamar = $responKamar['data'];
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        return view('admin.home', compact('data', 'dataKamar'));
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
