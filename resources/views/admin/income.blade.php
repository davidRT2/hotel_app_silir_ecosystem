@extends('admin/main')

@section('title', 'History')

@section('breadcrumbs')
@php
$data = [
[
'month' => 'January',
'total_pemasukan' => 5000000,
],
[
'month' => 'February',
'total_pemasukan' => 7500000,
],
[
'month' => 'March',
'total_pemasukan' => 6000000,
],
// tambahkan data bulan lainnya jika diperlukan
];


@endphp
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Income</h1>
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
<div class="row">


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

            <div class="">
                <div class="col-md-6">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Total Pemasukan</h1>
                            <p align='right'><a href="#" class="btn btn-sm btn-warning">Export PDF</a></p>
                            <div class="">
                                <div class="">
                                    <table class="table table-striped">
                                        @php
                                        $no = 0;
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Month</th>
                                                <th>Total Pemasukan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $no = 1;
                                            @endphp
                                            @foreach($data as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item['month'] }}</td>
                                                <td>{{ $item['total_pemasukan'] }}</td>
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
    </div>


    @endsection