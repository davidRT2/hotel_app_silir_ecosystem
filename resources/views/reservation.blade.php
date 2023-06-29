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
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Nama</span>
                                    <input class="form-control" type="text" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Nomor Telepon</span>
                                    <input class="form-control" type="text" placeholder="Nomor Telepon" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Check In</span>
                                    <input class="form-control" type="date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Check Out</span>
                                    <input class="form-control" type="date" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="form-label">Room Type</span>
                            <select class="form-control" required>
                                <option value="" selected hidden>Select room type</option>
                                <option>Private Room (1 to 2 People)</option>
                                <option>Family Room (1 to 4 People)</option>
                            </select>
                            <span class="select-arrow"></span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Kode Tiket</span>
                                    <input class="form-control" type="text" placeholder="Kode Tiket" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <span class="form-label">Kode Parkir</span>
                                    <input class="form-control" type="text" placeholder="Kode Parkir" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-btn">
                            <button class="submit-btn">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection