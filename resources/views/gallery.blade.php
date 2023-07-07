@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/stylecard.css">
<br>
<h1 style="text-align: center; font-weight:bolder;">Our Gallery</h1>
<div class="gtco-container" style="background-color: #1f1f1f">
    <div class="card-container">
        <div class="card">
            <img src="img/suite-room.jpg" alt="..." class="card__image" />
            <div class="card__body">
                <div>
                    <h2 class="card__category">Suite Room</h2>
                    <p class="card__price">Rp. 2.000.000/night</p>
                </div>
                <a href="{{ url('detail-kamar', ['id' => 'K002']) }}" class="card__button">Details</a>
            </div>
        </div>
        <div class="card">
            <img src="img/standart-room.jpg" alt="..." class="card__image" />
            <div class="card__body">
                <div>
                    <h2 class="card__category">Standart Room</h2>
                    <p class="card__price">Rp. 500.000/night</p>
                </div>
                <a href="{{ url('detail-kamar', ['id' => 'K001']) }}" class="card__button">Details</a>
            </div>
        </div>
        <div class="card">
            <img src="img/deluxe-room.jpg" alt="..." class="card__image" />
            <div class="card__body">
                <div>
                    <h2 class="card__category">Deluxe Room</h2>
                    <p class="card__price">Rp. 1.000.000/night</p>
                </div>
                <a href="{{ url('detail-kamar', ['id' => 'K003']) }}" class="card__button">Details</a>
            </div>
        </div>
    </div>
</div>
<br><br><br>
@endsection