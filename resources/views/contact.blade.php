@extends('layouts.app')

@section('content')
<br>
<div class="gtco-container">
    <div>
        <h1 style="text-align:center;font-weight:bolder;">Contact Us</h1>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <div id="googlemap" style="width:100%; height:350px;"></div>
        </div>
        <br />
        <div class="col-md-6">
            <form class="my-form">
                <div class="form-group">
                    <label for="form-name">Name</label>
                    <input type="email" class="form-control" id="form-name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="form-email">Alamat Email</label>
                    <input type="email" class="form-control" id="form-email" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="form-subject">Telepon</label>
                    <input type="text" class="form-control" id="form-subject" placeholder="Subject">
                </div>
                <div class="form-group">
                    <label for="form-message">Kirim pesan anda</label>
                    <textarea class="form-control" id="form-message" placeholder="Message"></textarea>
                </div>
                <button class="btn btn-default" type="submit">Contact Us</button>
            </form>
        </div>
    </div>
</div>
<br><br><br>

<style>
    .my-form {
        color: #305896;
    }

    .my-form .btn-default {
        background-color: #ff7f00;
        color: #fff;
        border-radius: 0;
    }

    .my-form .btn-default:hover {
        background-color: #ffa500;
        color: #fff;
    }

    .my-form .form-control {
        border-radius: 0;
    }
</style>
@endsection