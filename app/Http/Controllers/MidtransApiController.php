<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;
use Nette\Utils\Json;
use SebastianBergmann\Environment\Console;

class MidtransApiController extends Controller
{
    //
    private $baseUrl = "localhost:8080/api/v1/";
    public function index()
    {
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
                    'name' => ' Hari ' . $nama_kamar
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
        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => 12345, // Nilai order_id yang statis (misalnya 12345)
        //         'gross_amount' => 200000, // Nilai gross_amount yang statis (misalnya 200000)
        //     ),
        //     'item_details' => array(
        //         array(
        //             'id' => 1, // Nilai id yang statis (misalnya 1)
        //             'price' => 100000, // Nilai price yang statis (misalnya 100000)
        //             'quantity' => 2, // Nilai quantity yang statis (misalnya 2)
        //             'name' => 'Hari Kamar Deluxe', // Nama item yang statis
        //         ),
        //     ),
        //     'customer_details' => array(
        //         'first_name' => 'John', // Nama depan yang statis (misalnya John)
        //         'last_name' => 'Doe', // Nama belakang yang statis (misalnya Doe)
        //         'email' => 'john.doe@example.com', // Alamat email yang statis
        //         'phone' => '081234567890', // Nomor telepon yang statis (misalnya 081234567890)
        //     ),
        // );
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

    public function test(Request $request)
    {
        $json = str_replace("\\", "", $request->input('json'));
        $data = json_decode($json, true);
        return $data;
    }

    // public function payment_post(Request $request)
    // {
    //     // Ambil data dari $request
    //     $json = str_replace("\\", "", $request->input('json'));
    //     $data = json_decode($json, true);
    //     $formData = $data['formData'];
    //     // return $formData['nama'];
    //     $apiRes = $data;
    //     $tipe = $formData['tipe'];
    //     $id_penginap = $this->generateID_penginap();
    //     $nama_penginap = $formData['nama'];
    //     $id_kamar = $this->autoKamar($tipe);
    //     $durasi = $formData['durasi'];
    //     $check_in = $formData['checkIn'];
    //     $check_out = $formData['checkOut'];
    //     $telepon = $formData['nomor'];
    //     $gross_amount = $data['gross_amount'];
    //     $kodeParkir = $formData['kode-parkir'];
    //     $kodeTicket = $formData['kode-ticket'];
    //     $client = new Client();
    //     $url = $this->baseUrl . "penginap/";
    //     $urlHistory = $this->baseUrl . "history";
    //     $dataPenginap = [
    //         'id_penginap' => $id_penginap,
    //         'nama_penginap' => $nama_penginap,
    //         'id_kamar' => $id_kamar,
    //         'durasi' => $durasi,
    //         'check_in' => $check_in,
    //         'telepon' => $telepon,
    //         'status' => 1
    //     ];
    //     $dataHistory = [
    //         'id_penginap' => $id_penginap,
    //         'id_kamar' => $id_kamar,
    //         'durasi' => $durasi,
    //         'check_in' => $check_in,
    //         'check_out' => $check_out,
    //         'total_bayar' => $gross_amount,
    //         'penalty' => 0,
    //         'waktu' => '', // Isi dengan nilai waktu yang sesuai
    //         'status' => 0 // Isi dengan nilai status yang sesuai
    //     ];

    //     try {
    //         $historyResponse = $client->post($urlHistory, [
    //             'json' => $dataHistory,
    //             'headers' => [
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'verify' => false,
    //         ]);
    //         $response = $client->post($url, [
    //             'json' => $dataPenginap,
    //             'headers' => [
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'verify' => false,
    //         ]);
    //         $responseBody = $response->getBody()->getContents();
    //         // return response()->json(['message' => 'Data berhasil dikirim ke API'], 200);
    //         return Redirect::route('admin.home')->with('success', 'Transaksi Berhasil');
    //     } catch (\Exception $e) {
    //         // return response()->json(['error' => 'Gagal mengirim data ke API'], 500);
    //         return Redirect::route('admin.home')->with('error', '500 Failed to send data to API');
    //     }
    // }
    public function payment_post(Request $request)
    {
        // Ambil data dari $request
        $json = str_replace("\\", "", $request->input('json'));
        $data = json_decode($json, true);
        $formData = $data['formData'];
        $apiRes = $data;
        $tipe = $formData['tipe'];
        $id_penginap = $this->generateID_penginap();
        $nama_penginap = $formData['nama'];
        $id_kamar = $this->autoKamar($tipe);
        $durasi = $formData['durasi'];
        $check_in = $formData['checkIn'];
        $check_out = $formData['checkOut'];
        $telepon = $formData['nomor'];
        $gross_amount = $data['gross_amount'];
        $kodeParkir = $formData['kode-parkir'];
        $kodeTicket = $formData['kode-ticket'];
        $client = new Client();
        $url = "localhost:8080/api/v1/penginap/";
        $urlHistory = $this->baseUrl . "history";
        $dataPenginap = [
            'id_penginap' => $id_penginap,
            'nama_penginap' => $nama_penginap,
            'id_kamar' => $id_kamar == null? "K019" : $id_kamar,
            'durasi' => $durasi,
            'check_in' => $check_in,
            'telepon' => $telepon,
            'status' => 1
        ];
        $dataHistory = [
            'id_penginap' => $id_penginap,
            'id_kamar' => $id_kamar,
            'durasi' => $durasi,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'total_bayar' => $gross_amount,
            'penalty' => 0,
            'waktu' => '', // Isi dengan nilai waktu yang sesuai
            'status' => 0 // Isi dengan nilai status yang sesuai
        ];

        try {
            $response = $client->post($url, [
                'json' => $dataPenginap,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);
            $historyResponse = $client->post($urlHistory, [
                'json' => $dataHistory,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);
            $responseBody = $historyResponse->getBody()->getContents();
            // return response()->json(['message' => 'Data berhasil dikirim ke API'], 200);
            return Redirect::route('admin.home')->with('success', 'Transaksi Berhasil');
        } catch (\Exception $e) {
            // return response()->json(['error' => 'Gagal mengirim data ke API'], 500);
            return Redirect::route('admin.home')->with('error', '500 Failed to send data to API');
        }
    }


    // public function autoKamar($x)
    // {
    //     $client = new Client();
    //     $url = $this->baseUrl . 'kamar';
    //     $response = $client->request('GET', $url, [
    //         'verify' => false, // Set it to true for valid SSL certificates
    //     ]);
    //     $responseBody = json_decode($response->getBody(), true);
    //     $data = $responseBody['data'];

    //     // Cari kamar dengan id_tipe yang sesuai dan id_penginap kosong (null)
    //     $availableKamar = null;
    //     foreach ($data as $kamar) {
    //         if ($kamar['id_tipe'] === $x && empty($kamar['id_penginap'])) {
    //             $availableKamar = $kamar;
    //             break; // Keluar dari loop jika sudah ditemukan kamar yang sesuai
    //         }
    //     }

    //     if ($availableKamar) {
    //         // Jika ada kamar yang sesuai, kembalikan id_kamar dari kamar tersebut
    //         return $availableKamar['id_kamar'];
    //     } else {
    //         // Jika tidak ada kamar yang sesuai, kembalikan null atau nilai lain sesuai kebutuhan
    //         return null;
    //     }
    // }
    public function autoKamar($x)
    {
        $client = new Client();
        $url = $this->baseUrl . 'kamar';
        $response = $client->request('GET', $url, [
            'verify' => false,
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];

        // Cari kamar dengan id_tipe yang sesuai dan id_penginap kosong (null atau "")
        $availableKamar = null;
        foreach ($data as $kamar) {
            if ($kamar['id_tipe'] === $x && ($kamar['id_penginap'] === null || $kamar['id_penginap'] === "")) {
                $availableKamar = $kamar;
                break; // Keluar dari loop jika sudah ditemukan kamar yang sesuai
            }
        }

        if ($availableKamar) {
            // Jika ada kamar yang sesuai, kembalikan id_kamar dari kamar tersebut
            return $availableKamar['id_kamar'];
        } else {
            // Jika tidak ada kamar yang sesuai, kembalikan null atau nilai lain sesuai kebutuhan
            return null;
        }
    }





    public function generateID_penginap()
    {
        $data = $this->getPenginap();
        $dataLength = count($data);

        if ($dataLength > 0) {
            // Ambil angka terakhir dari ID penginap saat ini
            $lastID = intval(substr($data[$dataLength - 1]['id_penginap'], 1));

            // Tambahkan 1 untuk mendapatkan angka berikutnya
            $nextID = $lastID + 1;

            // Format angka berikutnya menjadi ID penginap baru
            $newID = 'P' . str_pad($nextID, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada data, generate ID penginap pertama
            $newID = 'P001';
        }

        return $newID;
    }

    public function payment_post_test(Request $request)
    {
        $json = str_replace("\\", "", $request->input('json'));
        $data = json_decode($json, true);
        $formData = $data['formData'];
        $apiRes = $data;
        return $data['gross_amount'];
    }

    public function getHistory()
    {
        $client = new Client();
        $url = $this->baseUrl . 'history'; // Correct the URL here
        $response = $client->request('GET', $url, [
            'verify' => false, // Set it to true for valid SSL certificates
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        return $data;
    }

    public function getPenginap()
    {
        $client = new Client();
        $url = $this->baseUrl . 'penginap/'; // Correct the URL here
        $response = $client->request('GET', $url, [
            'verify' => false, // Set it to true for valid SSL certificates
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];
        return $data;
    }
}
