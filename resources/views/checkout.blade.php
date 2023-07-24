@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking Details</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('checkout') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $nama }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nomorTelepon" class="col-md-4 col-form-label text-md-right">Nomor Telepon</label>

                            <div class="col-md-6">
                                <input id="nomorTelepon" type="text" class="form-control" name="nomorTelepon" value="{{ $nomorTelepon }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="checkIn" class="col-md-4 col-form-label text-md-right">Check In</label>

                            <div class="col-md-6">
                                <input id="checkIn" type="date" class="form-control" name="checkIn" value="{{ $checkIn }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="checkOut" class="col-md-4 col-form-label text-md-right">Check Out</label>

                            <div class="col-md-6">
                                <input id="checkOut" type="date" class="form-control" name="checkOut" value="{{ $checkOut }}" required readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roomType" class="col-md-4 col-form-label text-md-right">Room Type</label>

                            <div class="col-md-6">
                                <select id="roomType" class="form-control" name="roomType" required readonly>
                                    <option value="{{ $roomType }}" selected>{{ $roomType }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kodeTiket" class="col-md-4 col-form-label text-md-right">Kode Tiket</label>

                            <div class="col-md-6">
                                <input id="kodeTiket" type="text" class="form-control" name="kodeTiket" value="{{ $kodeTiket }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kodeParkir" class="col-md-4 col-form-label text-md-right">Kode Parkir</label>

                            <div class="col-md-6">
                                <input id="kodeParkir" type="text" class="form-control" name="kodeParkir" value="{{ $kodeParkir }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="noBooking" class="col-md-4 col-form-label text-md-right">No. Booking</label>

                            <div class="col-md-6">
                                <input id="noBooking" type="text" class="form-control" name="noBooking" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Bayar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection