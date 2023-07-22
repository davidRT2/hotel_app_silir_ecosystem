@extends('admin/main')

@section('title', 'Add New')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Add New Customer</h1>
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
                    <!-- Credit Card -->
                    <div>
                        <form action="{{ route('booking') }}" method="post" id="bayar">
                            @csrf
                            <div class="form-group text-center">
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class=" form-control-label">Check In</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input class="form-control" id="checkIn" type="date" name="check-in" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Check Out</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input class="form-control" id="checkOut" type="date" name="check-out" required>
                                    </div>
                                </div>
                                <input type="hidden" id="durasi" name="durasi">
                                <div class="col-md-6">
                                    <label class=" form-control-label">Nama</label>
                                    <div class="input-group">
                                        <input class="form-control" id="input-nama" type="text" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Tipe Kamar</label>
                                    <input type="hidden" name="namaKamar" id="namaKamar">
                                    <select id="select" class="form-control" name="tipe" required>
                                        @if (!empty($data))
                                        <option value="">Please select</option>
                                        @foreach($data as $tipe)
                                        <option value="{{ $tipe['id_tipe'] }}">{{ $tipe['nama_tipe'] }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Nomor Telepon</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="nomor" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class=" form-control-label">Kode Parkir</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="kode-parkir">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class=" form-control-label">Kode Ticket</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="kode-ticket">
                                    </div>
                                </div>
                                <small class="form-text text-muted text-right"><strong>**</strong>Jika tidak memiliki kode tiket/ Kode parkir maka dikenakan tarif normal</small>
                                <br>
                                <div class="col-md-3 offset-md-6">
                                    <button onclick="" type="submit" class="btn btn-md btn-primary">
                                        <i class="fa fa-save fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Proses Booking</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div> <!-- .card -->
    </div>
</div>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    // payButton.addEventListener('click', function(event) {
    $('#bayar').submit(function(event) {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        event.preventDefault()
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "{{ route('booking') }}",
            data: $('#bayar').serialize(),
            success: function(msg) {
                window.snap.pay(msg, {
                    onSuccess: function(result) {
                        /* You may add your own implementation here */
                        alert("payment success!");
                        console.log(result);
                        // getRoom();
                    },
                    onPending: function(result) {
                        /* You may add your own implementation here */
                        alert("wating your payment!");
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
                })

            }
        });
        // customer will be redirected after completing payment pop-up
    });

    // function getRoom() {
    //     $.ajax({
    //         url: '/testing', // Ganti dengan URL rute yang sesuai
    //         type: 'GET',
    //         dataType: 'json', // Tipe data yang diharapkan dari respons
    //         success: function(response) {
    //             // Response sukses dari rute akan diterima di sini
    //             console.log(response);
    //         },
    //         error: function(xhr, status, error) {
    //             // Tangani kesalahan jika ada
    //             console.log('Error:', error);
    //         }
    //     });

    // };
</script>

<script>
    $(document).ready(function() {
        $('#select').change(function() {
            var kamar = $(this).val();
            $('#namaKamar').val(kamar);
        });
    });
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
        $('#durasi').val(numberOfDays);
    });
</script>
@endsection