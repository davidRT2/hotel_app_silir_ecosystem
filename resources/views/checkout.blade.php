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
                            <h2>Booking Details</h2>
                            <p>Kami menyediakan kenyamanan dan fasilitas yang terkoneksi ke seluruh lingkungan pariwisata silir</p>
                        </div>
                    </div>
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Nama</span>
                                    <input class="form-control" type="text" placeholder="Nama Lengkap" value="{{ $nama }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Nomor Telepon</span>
                                    <input class="form-control" type="text" placeholder="Nomor Telepon" value="{{ $nomorTelepon }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Check In</span>
                                    <input class="form-control" type="date" value="{{ $checkIn }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Check Out</span>
                                    <input class="form-control" type="date" value="{{ $checkOut }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="form-label">Room Type</span>
                            <select class="form-control" disabled>
                                <option value="{{ $roomType }}" selected>{{ $roomType }}</option>
                            </select>
                            <span class="select-arrow"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Kode Tiket</span>
                                    <input class="form-control" type="text" placeholder="Kode Tiket" value="{{ $kodeTiket }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Kode Parkir</span>
                                    <input class="form-control" type="text" placeholder="Kode Parkir" value="{{ $kodeParkir }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">No. Booking</span>
                                    <input class="form-control" type="text" placeholder="No. Booking" name="no_booking" required>
                                </div>
                            </div>
                            <div class="form-btn">
                                <button type="submit" class="submit-btn">Checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection