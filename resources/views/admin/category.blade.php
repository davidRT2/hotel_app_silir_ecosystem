@extends('admin/main')

@section('title', 'Room')

@section('breadcrumbs')
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
                                <div class="row">


                                    <div class="col-md-2">
                                        <label class=" form-control-label">Prefix Kode Kamar</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-4">
                                        <label class=" form-control-label">Tipe Kamar</label>
                                        <select name="select" id="select" class="form-control">
                                            <option value="">Please select</option>
                                            @foreach($data as $tipe)
                                            <option value="{{ $tipe['id_tipe'] }}">{{ $tipe['nama_tipe'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class=" form-control-label">Jumlah kamar</label>
                                        <div class="input-group">
                                            <input class="form-control"  type="number" min="0" pattern="^[0-9]+$" oninput="validateInput(this)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class=" form-control-label">Harga kamar</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            <input class="form-control" type="text" id="rupiah" oninput="formatRupiah(this)">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-3 offset-md-6">
                                    <button id="payment-button" type="submit" class="btn btn-md btn-warning">
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
                    <div class="page-header">
                        <div class="page-title">
                            <div class="table">
                                <table class="table table-striped">
                                    @php
                                    $no = 0;
                                    @endphp
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Kamar</th>
                                            <th>Jenis Kamar</th>
                                            <th>Harga Kamar</th>
                                            <th>Available</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data2 as $item)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $item['id_kamar'] }}</td>
                                            <td>{{ $item['nama_tipe'] }}</td>
                                            <td>{{ $item['harga_per_malam'] }}</td>
                                            <td>
                                                @if ($item['id_penginap'] === null)
                                                <span class="badge badge-success">Tersedia</span>
                                                @else
                                                <span class="badge badge-warning">Dipesan</span>
                                                @endif
                                            </td>
                                            <!-- <td>
                                                <button type="button" class="btn-sm btn-warning">Edit</button>
                                                <button type="button" class="btn-sm btn-danger">Hapus</button>
                                            </td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> <!-- .card -->
    </div>
</div>
@endsection