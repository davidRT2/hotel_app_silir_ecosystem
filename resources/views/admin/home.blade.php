@extends('admin/main')

@section('title', 'Dashboard')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <!-- <li><a href="#">Dashboard</a></li> -->
                    <li class="active"><i class="fa fa-dashboard"></i></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-0">
                        <i class="fa-solid fa-face-smile"></i>
                        <span class="count">{{ $jumlahPenginap }}</span>
                    </h4>
                    <h4 class="text-light">Jumlah Penginap Saat Ini</h4>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                        @php
                        $countAvailableRoom = 0;
                        $countBookedRoom = 0;
                        foreach ($dataKamar as $kamar){
                        if($kamar['id_penginap'] === NULL || $kamar['id_penginap'] === ""){
                        $countAvailableRoom++;
                        }else{
                        $countBookedRoom++;
                        }
                        }
                        @endphp
                    </div>
                    <h4 class="mb-0">
                        <span class="count">{{ $countAvailableRoom }}</span>
                    </h4>
                    <h4 class="text-light">Jumlah Kamar Tersedia</h4>

                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart4"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-0">
                        <span class="count">{{ $countBookedRoom }}</span>
                    </h4>
                    <h4 class="text-light">Jumlah Kamar Terpakai</h4>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="breadcrumbs">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="page-title">
                        <h1>Data Pengunjung</h1>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                @php
                                $no = ($data2->currentPage() - 1) * $data2->perPage() + 1;
                                @endphp
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pengunjung</th>
                                        <th>ID Kamar</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data2 as $item)
                                    @if ($item['status'])
                                    <tr id="rowPenginap">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item['id_penginap'] }}</td>
                                        <td>{{ $item['id_kamar']}}</td>
                                        <td>{{ $item['nama_penginap'] }}</td>
                                        <td>{{ $item['telepon'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item['check_in'])->format('Y-m-d') }}</td>
                                        <td>
                                            <?php
                                            // Calculate the checkout date
                                            $checkInDate = \Carbon\Carbon::parse($item['check_in']);
                                            $duration = $item['durasi']; // Assuming 'durasi' is the column for duration
                                            $checkoutDate = $checkInDate->copy()->addDays($duration);
                                            ?>
                                            {{ $checkoutDate->format('Y-m-d') }}
                                        </td>
                                        <td style="display:none;">
                                            @php
                                            $date = \Carbon\Carbon::parse($checkoutDate);
                                            @endphp
                                            {{$date = Carbon\Carbon::parse($date)->diffInDays()}}
                                        </td>
                                        <td style="display:none;">{{ $item['nama_tipe'] }}</td>
                                        <td>
                                            <button type="button" class="btn-sm btn-danger" data-toggle="modal" data-target="#ModalCheckout" data-idpenginap="{{ $item['id_penginap'] }}">checkout</button>
                                            <button style="display: none;" type="hidden" class="btn-sm btn-primary" data-toggle="modal" data-target="#ModalPerpanjang" data-idpenginap="{{ $item['id_penginap'] }}">Perpanjang</button>
                                        </td>
                                    </tr>
                                    @else(continue)
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class=" pagination justify-content-end">
                        {{ $data2->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

        </div>
        <!-- Modal Konfirmasi Checkout -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ModalCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Konfirmasi Checkout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('history.status') }}" method="post">
                        @csrf
                        <div class="container fluid">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Kode Booking</label>
                                <input id="kodeBooking" name="idBooking" type="text" class="form-control" aria-required="true" aria-invalid="false" readonly>
                            </div>
                            <div class="form-group has-success">
                                <label for="cc-name" class="control-label mb-1">Nama Tamu Penginap</label>
                                <input id="nama-penginap" name="cc-name" type="text" readonly class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="cc-number" class="control-label mb-1">Jenis Paket Kamar</label>
                                <input readonly id="jenisLayanan" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                                <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Estimasi Tanggal Keluar</label>
                                        <input readonly id="estimasi" name="date" type="text" class="form-control" value="">
                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1" id="keterangan">Waktu Tersisa</label>
                                    <div class="input-group">
                                        <input readonly id="penalty" name="x_card_code" type="tel" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                                        <!-- <div class="input-group-addon">
                                        <span class="fa fa-question-circle fa-lg" data-toggle="popover" data-container="body" data-html="true" data-title="Security Code" data-content="<div class='text-center one-card'>The 3 digit code on back of the card..<div class='visa-mc-cvc-preview'></div></div>" data-trigger="hover"></span>
                                    </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="prosesCheckout" type="submit" class="btn btn-warning">Proses Checkout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Perpanjangan -->
    <div class="modal fade" id="ModalPerpanjang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Perpanjangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container fluid">
                        <div class="form-group text-center">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="text-muted fa fa-cc-visa fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-mastercard fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-amex fa-2x"></i></li>
                                <li class="list-inline-item"><i class="fa fa-cc-discover fa-2x"></i></li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Kode Booking</label>
                            <input id="cc-pament" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" value="100.00">
                        </div>
                        <div class="form-group has-success">
                            <label for="cc-name" class="control-label mb-1">Name on card</label>
                            <input id="cc-name" name="cc-name" type="text" class="form-control cc-name valid" data-val="true" data-val-required="Please enter the name on card" autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Card number</label>
                            <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" value="" data-val="true" data-val-required="Please enter the card number" data-val-cc-number="Please enter a valid card number" autocomplete="cc-number">
                            <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Expiration</label>
                                    <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" value="" data-val="true" data-val-required="Please enter the card expiration" data-val-cc-exp="Please enter a valid month and year" placeholder="MM / YY" autocomplete="cc-exp">
                                    <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="x_card_code" class="control-label mb-1">Security code</label>
                                <div class="input-group">
                                    <input id="x_card_code" name="x_card_code" type="tel" class="form-control cc-cvc" value="" data-val="true" data-val-required="Please enter the security code" data-val-cc-cvc="Please enter a valid security code" autocomplete="off">
                                    <div class="input-group-addon">
                                        <span class="fa fa-question-circle fa-lg" data-toggle="popover" data-container="body" data-html="true" data-title="Security Code" data-content="<div class='text-center one-card'>The 3 digit code on back of the card..<div class='visa-mc-cvc-preview'></div></div>" data-trigger="hover"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bagian JavaScript -->
    <script>
        $(document).ready(function() {
            // Aksi ketika tombol "checkout" ditekan
            $('.btn-danger').click(function() {
                var currentTds = $(this).closest("tr").find("td"); // find all td of selected row
                var id_penginap = $(currentTds).eq(1).text(); // eq= cell , text = inner text
                var id_kamar = $(currentTds).eq(2).text();
                var nama = $(currentTds).eq(3).text();
                var telepon = $(currentTds).eq(4).text();
                var checkIn = $(currentTds).eq(5).text();
                var checkOut = $(currentTds).eq(6).text();
                var selisih = $(currentTds).eq(7).text();
                var nama_layanan = $(currentTds).eq(8).text();
                // var selisih = -2;
                // Parse the date string and format it as 'yyyy-mm-dd'
                var checkOutDate = new Date(checkOut);
                var formattedCheckOutDate = checkOutDate.toISOString().slice(0, 10);
                var currDate = new Date();
                var formattedCheckOutDate = currDate.toISOString().slice(0, 10);
                console.log(selisih);
                $('#kodeBooking').val(id_penginap);
                $('#nama-penginap').val(nama);
                $('#jenisLayanan').val(id_kamar + "-" + nama_layanan);
                $('#estimasi').val(formattedCheckOutDate); // Clear the value of Estimasi Tanggal Keluar
                $('#penalty').val(Math.abs(parseInt(selisih))); // Clear the value of Lewat Batas
                if (selisih < 0) {
                    $('#keterangan').text('Lewat Batas /Hari');
                    $('.modal-title').addClass('badge badge-danger');
                    $('.modal-title').text('Penalty Konfirmasi Checkout');
                } else {
                    $('.modal-title').removeClass('badge badge-danger');
                    $('.modal-title').text('Konfirmasi Checkout');
                    $('#keterangan').text('Waktu Tersisa /Hari');
                }
            });
            //aksi saat tombol perpanjang diperpanjang
            $('.btn-primary').click(function() {
                var currentTds = $(this).closest("tr").find("td"); // find all td of selected row
                var id_penginap = $(currentTds).eq(1).text(); // eq= cell , text = inner text
                var id_kamar = $(currentTds).eq(2).text();
                var nama = $(currentTds).eq(3).text();
                var telepon = $(currentTds).eq(4).text();
                var checkIn = $(currentTds).eq(5).text();
                var checkOut = $(currentTds).eq(6).text();
                console.log(id_penginap);
                console.log(id_kamar);
                console.log(nama);
                console.log(telepon);
                console.log(checkIn);
                console.log(checkOut);
            });
        });
    </script>
    @endsection