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
                    <form action="{{ route('booking') }}" method="post" id="bayar">
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
                        </div>
                        <!-- Tambahkan tombol "Bayar" untuk menampilkan Snap Midtrans -->
                        <button id="bayarButton" class="btn btn-primary"><i class="fas fa-money-bill"></i> Bayar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#bayarButton").click(function(event) { // Mengubah event dari submit form menjadi click tombol "Bayar"
            // Mengambil data form
            event.preventDefault()
            var formData = $("#bayar").serialize();
            var data = {
                checkIn: $('#checkIn').val(),
                checkOut: $('#checkOut').val(),
                durasi: $('#durasi').val(),
                nama: $('#input-nama').val(),
                tipe: $('#select').val(),
                nomor: $('#nomorTelepon').val(),
                'kode-parkir': $('#kodeParkir').val(),
                'kode-ticket': $('#kodeTicket').val()
            }
            // Mengirim data form ke controller dengan AJAX
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ route('booking') }}", // Ganti menjadi '/booking'
                data: formData,
                success: function(msg) {
                    // Berhasil, lakukan sesuatu jika perlu
                    snap.pay(msg, {
                        onSuccess: function(result) {
                            /* You may add your own implementation here */
                            alert("payment success!");
                            result['formData'] = data;
                            sendDataBook(result);
                            // getRoom();
                        },
                        onPending: function(result) {
                            /* You may add your own implementation here */
                            alert("waiting for your payment!");
                            console.log(result);
                        },
                        onError: function(result) {
                            /* You may add your own implementation here */
                            alert("payment failed!");
                            console.log(result);
                        },
                        onClose: function() {
                            /* You may add your own implementation here */
                            alert('you closed the popup without finishing the payment');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Error handling code here
                    console.log("Ajax request failed!");
                    console.log("Status: " + status);
                    console.log("Error message: " + error);
                }
            });
        });
    });

    function sendDataBook(result) {
        document.getElementById('json_callback').value = JSON.stringify(result);
        $('#submit_form').submit();
    }
</script>

<script>
    $('#checkOut').change(function() {
        var checkIn = $('#checkIn').val();
        var checkOut = $('#checkOut').val();

        // Convert date strings to Date objects
        const checkinDate = new Date(checkIn);
        const checkoutDate = new Date(checkOut);

        // Calculate the time difference in milliseconds
        const timeDiff = checkoutDate - checkinDate;

        // Convert milliseconds to days
        const numberOfDays = timeDiff / (1000 * 60 * 60 * 24);

        // Set the calculated duration in the "durasi" input
        $('#durasi').val(numberOfDays);
    })
</script>

<!-- Add the following hidden form to submit data to the server -->
<form id="submit_form" method="post" action="{{ route('pay.post') }}">
    @csrf
    <input type="hidden" name="json" id="json_callback" value="">
</form>
@endsection