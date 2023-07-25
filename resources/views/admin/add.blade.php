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
                                        <input type="hidden" id="durasi" name="durasi">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Nama</label>
                                    <div class="input-group">
                                        <input class="form-control" id="input-nama" type="text" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Tipe Kamar</label>
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
                                        <input id="nomorTelepon" class="form-control" type="number" name="nomor" required>
                                    </div>
                                </div>
                                <div class="col-md-3" style="display:none">
                                    <label class=" form-control-label">Kode Parkir</label>
                                    <div class="input-group">
                                        <input id="kodeParkir" class="form-control" type="number" name="kode-parkir">
                                    </div>
                                </div>
                                <div class="col-md-3" style="display:none">
                                    <label class=" form-control-label">Kode Ticket</label>
                                    <div class="input-group">
                                        <input id="kodeTicket" class="form-control" type="number" name="kode-ticket">
                                    </div>
                                </div>
                                <small class="form-text text-muted text-right"><strong>**</strong>Jika tidak memiliki kode tiket/ Kode parkir maka dikenakan tarif normal</small>
                                <br>
                                <div class="col-md-3 offset-md-6">
                                    <button id="tombol" onclick="" type="submit" class="btn btn-md btn-primary">
                                        <i class="fa fa-save fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Proses Booking</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    </button>
                                </div>
                        </form>
                    </div>
                    <form action="{{ route('pay.post') }}" method="POST" id="submit_form">
                        @csrf
                        <input type="hidden" name="json" id="json_callback">
                    </form>
                </div>

            </div>
        </div> <!-- .card -->
    </div>
</div>
<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    // payButton.addEventListener('click', function(event) {
    $(document).ready(function() {
        $("#bayar").submit(function(event) {
            // Mengambil data form
            event.preventDefault()
            var formData = $("#bayar").serialize();
            var data = {
                checkIn : $('#checkIn').val(),
                checkOut : $('#checkOut').val(),
                durasi : $('#durasi').val(),
                nama : $('#input-nama').val(),
                tipe : $('#select').val(),
                nomor : $('#nomorTelepon').val(),
                'kode-parkir' : $('#kodeParkir').val(),
                'kode-ticket' : $('#kodeTicket').val()
            }
            // Mengirim data form ke controller dengan AJAX
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ route('booking') }}",
                data: formData,
                success: function(msg) {
                    // Berhasil, lakukan sesuatu jika perlu
                    window.snap.pay(msg, {
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
    function sendDataBook(result){
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
@endsection