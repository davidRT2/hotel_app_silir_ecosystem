@extends('admin/main')

@section('title', 'History')

@section('breadcrumbs')
@php
$data = [
[
'id' => 'P001',
'id_kamar' => 'K001',
'nama' => 'Febri Adi Setyawan',
'telepon' => '08123456789',
'check_in' => '2023-07-01',
'check_out' => '2023-07-05',
],
[
'id' => 'P002',
'id_kamar' => 'K002',
'nama' => 'Muhammad David Akbar',
'telepon' => '08123456789',
'check_in' => '2023-07-01',
'check_out' => '2023-07-05',
],
[
'id' => 'P003',
'id_kamar' => 'K003',
'nama' => 'Lucky Nur Fitriana',
'telepon' => '08123456789',
'check_in' => '2023-07-01',
'check_out' => '2023-07-05',
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
        <div class="col-lg-12">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Team Commits </h4>
                        <canvas id="team-chart"></canvas>
                    </div>
                </div>
            </div><!-- /# column -->
        </div>

        <div class="breadcrumbs">
            <div class="col-md-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Pengunjung</h1>
                        <div class="card">
                            <div class="card-header">
                                <div class="pull-right">
                                    <!-- <a href="{{ url('barang/add') }}" class="btn btn-success btn-sm"> -->
                                    <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered">
                                    @php
                                    $no = 0;
                                    @endphp
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Pengunjung</th>
                                            <th>ID Kamar</th>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ $item['id_kamar'] }}</td>
                                            <td>{{ $item['nama'] }}</td>
                                            <td>{{ $item['telepon'] }}</td>
                                            <td>{{ $item['check_in'] }}</td>
                                            <td>{{ $item['check_out'] }}</td>
                                            <td>
                                                <button type="button" class="btn-sm btn-danger">checkout</button>
                                                <button type="button" class="btn-sm btn-primary">Perpanjang</button>
                                            </td>
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
    @endsection