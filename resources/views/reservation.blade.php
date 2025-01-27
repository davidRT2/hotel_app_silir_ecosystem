@extends('layouts.app')

@section('content')
<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<div id="booking" class="section">
    <div class="section-center">
        <div class="container">
            <div class="row">
                <div class="booking-form">
                    <div class="booking-bg">
                        <div class="form-header">
                            <h2>Reservation</h2>
                            <p>Kami menyediakan kenyamanan dan fasilitas yang terkoneksi ke seluruh lingkungan pariwisata silir</p>
                        </div>
                    </div>
                    <form action="{{ url('/checkout') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Nama</span>
                                    <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Nomor Telepon</span>
                                    <input class="form-control" type="text" placeholder="Nomor Telepon" name="nomor_telepon" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Check In</span>
                                    <input class="form-control" type="date" name="check_in" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Check Out</span>
                                    <input class="form-control" type="date" name="check_out" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="form-label">Room Type</span>
                            <select class="form-control" name="room_type" required>
                                <option value="" selected hidden>Select room type</option>
                                @foreach($data as $tipe)
                                <option value="{{ $tipe['id_tipe'] }}">{{ $tipe['nama_tipe'] }}</option>
                                @endforeach
                            </select>
                            <span class="select-arrow"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Kode Tiket</span>
                                    <input class="form-control" type="text" placeholder="Kode Tiket" name="kode_tiket" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Kode Parkir</span>
                                    <input class="form-control" type="text" placeholder="Kode Parkir" name="kode_parkir" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-btn">
                            <button type="submit" class="submit-btn">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection