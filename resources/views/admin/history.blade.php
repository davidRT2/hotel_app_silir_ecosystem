@extends('admin/main')

@section('title', 'History')

@section('breadcrumbs')
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
        <div class="col-sm-12" style="display: none;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="mb-3">Trend Penginap</h4>
                        <canvas id="sales-chart"></canvas>
                    </div>

                </div>
            </div>
        </div><!-- /# column -->
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
                    <h1><i class="menu-icon fa fa-database"></i><span class="count">{{ 'Rp ' . number_format($income, 0, ',', '.') }}</span></h1>
                    <h4 class="text-light">Total Pemasukan</h4>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>

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
                                            <th>Total Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                        @if($item['status'])
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $item['id_penginap'] }}</td>
                                            <td>{{ $item['nama_penginap'] }}</td>
                                            <td>{{  \Carbon\Carbon::parse($item['check_in'])->format('Y-m-d') }}</td>
                                            <td>{{  \Carbon\Carbon::parse($item['check_out'])->format('Y-m-d') }}</td>
                                            <td>{{ $item['total_bayar'] }}</td>
                                        </tr>
                                        @else(continue)
                                        @endif
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