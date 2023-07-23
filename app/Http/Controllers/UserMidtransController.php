<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use GuzzleHttp\Client;
use App\Models\Order; // Pastikan Anda telah mengimpor model Order jika diperlukan
use Illuminate\Support\Facades\Redirect;
use Nette\Utils\Json;
use SebastianBergmann\Environment\Console;

class UserMidtransController extends Controller
{
    private $baseUrl = "http://192.168.27.115:8080/api/v1/";

    public function checkout(Request $request)
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

        $snapToken = Snap::getSnapToken($params);
        return $snapToken;
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                // Assuming you have the Order model to handle orders
                $order = Order::find($request->order_id);
                $order->update(['status' => 'Paid']);
            }
        }
    }

    public function getDetail($id)
    {
        $client = new Client();
        $url = $this->baseUrl . 'tipe/' . $id;

        try {
            $response = $client->request('GET', $url, ['verify' => false]);
            $responseBody = json_decode($response->getBody(), true);
            $data = $responseBody['data'];
            return $data;
        } catch (\Exception $e) {
            return [];
        }
    }

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
        $url = $this->baseUrl . "penginap/";
        $urlHistory = $this->baseUrl . "history";
        $dataPenginap = [
            'id_penginap' => $id_penginap,
            'nama_penginap' => $nama_penginap,
            'id_kamar' => $id_kamar,
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
            $historyResponse = $client->post($urlHistory, [
                'json' => $dataHistory,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);
            $response = $client->post($url, [
                'json' => $dataPenginap,
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'verify' => false,
            ]);
            $responseBody = $response->getBody()->getContents();
            // return response()->json(['message' => 'Data berhasil dikirim ke API'], 200);
            return Redirect::route('admin.home')->with('success', 'Transaksi Berhasil');
        } catch (\Exception $e) {
            // return response()->json(['error' => 'Gagal mengirim data ke API'], 500);
            return Redirect::route('admin.home')->with('error', '500 Failed to send data to API');
        }
    }


    public function autoKamar($x)
    {
        $client = new Client();
        $url = $this->baseUrl . 'kamar';
        $response = $client->request('GET', $url, [
            'verify' => false, // Set it to true for valid SSL certificates
        ]);
        $responseBody = json_decode($response->getBody(), true);
        $data = $responseBody['data'];

        // Cari kamar dengan id_tipe yang sesuai
        $filteredKamar = array_filter($data, function ($kamar) use ($x) {
            return $kamar['id_tipe'] === $x;
        });

        // Cari kamar yang id_penginap == null
        $availableKamar = array_values(array_filter($filteredKamar, function ($kamar) {
            return $kamar['id_penginap'] === null;
        }));

        if (!empty($availableKamar)) {
            // Jika ada kamar yang tersedia, kembalikan id kamar pertama yang ditemukan
            return $availableKamar[0]['id_kamar'];
        } else {
            // Jika tidak ada kamar yang tersedia, kembalikan null atau nilai lain sesuai kebutuhan
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
