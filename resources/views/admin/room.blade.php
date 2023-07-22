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
                    <!-- add-Room Form -->
                    <div>
                        <form action="{{ route('add-room') }}" method="post">
                            @csrf
                            <div class="form-group text-center">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class=" form-control-label">Prefix Kode Kamar</label>
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="prefix" required>
                                        </div>
                                        <small class="form-text text-muted text-left"><strong>**</strong>Karakter untuk awalan IDKamar <b>Contoh K/KJ = K001/KJ001</b></small>
                                    </div>
                                    <div class="col-md-3">
                                        <label class=" form-control-label">Jumlah kamar</label>
                                        <div class="input-group">
                                            <input class="form-control" type="number" min="1" pattern="^[0-9]+$" oninput="validateInput(this)" name="room-amount" required>
                                        </div>
                                        <small class="form-text text-muted text-left"><strong>**</strong>Jumlah Kamar maksimal ditambahkan 20 Unit</small>
                                    </div>
                                    <div class="offset-md-6"></div>
                                    <div class="col-md-6">
                                        <label class=" form-control-label">Tipe Kamar</label>
                                        <select id="select" class="form-control" name="room-type" required>
                                            <option value="">Please select</option>
                                            @foreach($data as $tipe)
                                            <option value="{{ $tipe['id_tipe'] }}">{{ $tipe['nama_tipe'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-3 offset-md-10">
                                    <button id="payment-button" type="submit" class="btn btn-md btn-primary">
                                        <i class="fa fa-save fa-lg"></i>
                                        <span>Simpan Data</span>
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="breadcrumbs">
                <div class="col-md-12">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Data Kamar</h1>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    @php
                                    $no = ($data2->currentPage() - 1) * $data2->perPage() + 1;
                                    @endphp
                                    <thead class="thead-dark">
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
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item['id_kamar'] }}</td>
                                            <td>{{ $item['nama_tipe'] }}</td>
                                            <td>Rp. {{ number_format($item['harga_per_malam'], 0, ',', ',') }}</td>
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
                        <div class="float-left">
                            <p><strong>Jumlah Kamar : {{ $jumlahKamar }}</strong></p>
                        </div>
                        <div class="pagination justify-content-end">
                            {{ $data2->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>

            </div>
        </div> <!-- .card -->
    </div>
    @endsection