@extends('admin/main')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <!-- <li><a href="#">Dashboard</a></li> -->
                    <li class="active"><i class="fa fa-dashboard"></i></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
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
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-0">
                        <span class="count">45</span>
                    </h4>
                    <p class="text-light">Jumlah Penginap</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-0">
                        <span class="count">45</span>
                    </h4>
                    <p class="text-light">Jumlah Kamar Tersedia</p>

                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart4"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-0">
                        <span class="count">45</span>
                    </h4>
                    <p class="text-light">Jumlah Kamar Terpakai</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
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