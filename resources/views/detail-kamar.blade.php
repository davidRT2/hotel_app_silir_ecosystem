@extends('layouts.app')

@section('content')
<br>
<div class="gtco-container">
    <h1 style="text-align: center;"><b>DETAIL KAMAR</b></h1>
    <h2>{{ $data['nama_tipe'] }}</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="image-container">
                @if ($data['id_kamar'] == 'K001')
                <img src="{{ asset('img/standart-room.jpg') }}" alt="Standart Room" class="img-fluid">
                @elseif ($data['id_kamar'] == 'K002')
                <img src="{{ asset('img/deluxe-room.jpg') }}" alt="Deluxe Room" class="img-fluid">
                @elseif ($data['id_kamar'] == 'K003')
                <img src="{{ asset('img/suite-room.jpg') }}" alt="Suite Room" class="img-fluid">
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <h3>Harga per Malam:</h3>
            <p>{{ $data['harga_per_malam'] }}</p>
            <h3>Fasilitas:</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Fasilitas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['daftar_fasilitas'] as $fasilitas)
                    <tr>
                        <td>{{ $fasilitas['nama_fasilitas'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br><br>
@endsection