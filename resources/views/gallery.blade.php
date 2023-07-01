@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/stylecard.css">
<br>
<h1 style="text-align: center; font-weight:bolder;">Our Gallery</h1>
<div class="gtco-container" style="background-color: #1f1f1f">
    <div class="card-container">
        <div class="card">
            <img src="img/logo.jpeg" alt="..." class="card__image" />
            <div class="card__body">
                <div>
                    <h2 class="card__category">Suite Room</h2>
                    <p class="card__price">$99 per night</p>
                </div>
                <a href="#" class="card__button">Book Now</a>
            </div>
        </div>
        <div class="card">
            <img src="img/logo.jpeg" alt="..." class="card__image" />
            <div class="card__body">
                <div>
                    <h2 class="card__category">Standart Room</h2>
                    <p class="card__price">$99 per night</p>
                </div>
                <a href="#" class="card__button">Book Now</a>
            </div>
        </div>
        <div class="card">
            <img src="img/logo.jpeg" alt="..." class="card__image" />
            <div class="card__body">
                <div>
                    <h2 class="card__category">John Doe</h2>
                    <p class="card__price">$99 per night</p>
                </div>
                <a href="#" class="card__button">Book Now</a>
            </div>
        </div>
    </div>
</div>
<br><br><br>
@endsection