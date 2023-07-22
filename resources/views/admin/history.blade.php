@extends('admin/main')

@section('title', 'History')

@section('breadcrumbs')
@php
$data = [
[
'id_pengunjung' => 'P001',
'nama_pengunjung' => 'John Doe',
'check_in' => '2023-07-01',
'check_out' => '2023-07-05',
'penalty' => '0',
'total_bayar' => '500000',
],
[
'id_pengunjung' => 'P002',
'nama_pengunjung' => 'Jane Smith',
'check_in' => '2023-07-02',
'check_out' => '2023-07-07',
'penalty' => '50000',
'total_bayar' => '600000',
],
[
'id_pengunjung' => 'P003',
'nama_pengunjung' => 'Michael Johnson',
'check_in' => '2023-07-03',
'check_out' => '2023-07-08',
'penalty' => '200000',
'total_bayar' => '800000',
],
];

@endphp
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>History</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Trend Penginap</h4>
                    <canvas id="team-chart"></canvas>
                </div>
            </div>
        </div><!-- /# column -->

        <div class="breadcrumbs">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Riwayat Pengunjung</h1>
                        <div class="">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    @php
                                    $no = 0;
                                    @endphp
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Pengunjung</th>
                                            <th>Nama Pengunjung</th>
                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Penalty</th>
                                            <th>Total Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item['id_pengunjung'] }}</td>
                                            <td>{{ $item['nama_pengunjung'] }}</td>
                                            <td>{{ $item['check_in'] }}</td>
                                            <td>{{ $item['check_out'] }}</td>
                                            <td>{{ $item['penalty'] }}</td>
                                            <td>{{ $item['total_bayar'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('team-chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [{
                        label: 'Sales Summary',
                        data: [200, 300, 110, 200, 600, 700],
                        backgroundColor: 'rgba(0, 123, 255, 0.7)'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    @endsection