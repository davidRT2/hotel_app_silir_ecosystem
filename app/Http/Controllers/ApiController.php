<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    private $baseUrl = "https://422c-103-162-237-197.ngrok-free.app/api/v1/";

    public function getDataPenginap(Request $request)
    {
        $client = new Client();
        $url = $this->baseUrl . "penginap/";

        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);

        $urlKamar = $this->baseUrl . "kamar";

        $responKamar = $client->request('GET', $urlKamar, [
            'verify' => false,
        ]);
        $responKamar = json_decode($responKamar->getBody(), true);
        $dataKamar = $responKamar['data'];
        $responseBody = json_decode($response->getBody(), true);
        $jumlahPenginap = count($responseBody['data']);
        // return $data[0]['id_kamar'];
        $data2 = $this->paginate($responseBody['data'], 5, null, [], $request->fullUrl());
        return view('admin.home', compact('data2', 'dataKamar', 'jumlahPenginap'));
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

    public function getJenisLayanan($id)
    {
        $client = new Client();
        $url = $this->baseUrl . 'kamar/' . $id; // Correct the URL here
        $response = $client->request('GET', $url, [
            'verify' => false, // Set it to true for valid SSL certificates
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        return $data['nama_tipe'];
    }
}
