@extends('admin/main')

@section('title', 'Room')

@section('breadcrumbs')
@php
$data = [
[
'No' => 1,
'ID Kamar' => 'K001',
'Nama Kamar' => 'Kamar Lt 2',
'Jenis Kamar' => 'Luxury',
'Harga Kamar' => '2000.0000',
'Available' => 'Yes',
],
[
'No' => 2,
'ID Kamar' => 'K002',
'Nama Kamar' => 'Kamar Lt 2',
'Jenis Kamar' => 'Standard',
'Harga Kamar' => '500.000',
'Available' => 'No',
],
[
'No' => 3,
'ID Kamar' => 'K003',
'Nama Kamar' => 'Kamar Lt 3',
'Jenis Kamar' => 'Deluxe',
'Harga Kamar' => '250.000',
'Available' => 'Yes',
],
];

@endphp
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Room</h1>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Credit Card -->
                    <div id="pay-invoice">
                        <form action="" method="post" novalidate="novalidate">
                            <div class="form-group text-center">
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class=" form-control-label">ID Kamar</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Tipe Kamar</label>
                                    <select name="select" id="select" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Nama kamar</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Harga kamar</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <input class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Jumlah kamar</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-3 offset-md-6">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                                        <i class="fa fa-save fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Simpan Data</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    </button>
                                </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="breadcrumbs">
                <div class="col-md-12">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <div class="card">
                                <div class="card-body table">
                                    <table class="table table-striped">
                                        @php
                                        $no = 0;
                                        @endphp
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Kamar</th>
                                                <th>Nama Kamar</th>
                                                <th>Jenis Kamar</th>
                                                <th>Harga Kamar</th>
                                                <th>Available</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $item)
                                            <tr>
                                                <td>{{ $item['No'] }}</td>
                                                <td>{{ $item['ID Kamar'] }}</td>
                                                <td>{{ $item['Nama Kamar'] }}</td>
                                                <td>{{ $item['Jenis Kamar'] }}</td>
                                                <td>{{ $item['Harga Kamar'] }}</td>
                                                <td>{{ $item['Available'] }}</td>
                                                <td>
                                                    <button type="button" class="btn-sm btn-warning">Edit</button>
                                                    <button type="button" class="btn-sm btn-danger">Hapus</button>
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
        </div> <!-- .card -->
    </div>
</div>
@endsection