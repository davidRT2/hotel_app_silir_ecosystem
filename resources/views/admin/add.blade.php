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
                    <div id="pay-invoice">
                        <form action="" method="post" novalidate="novalidate">
                            <div class="form-group text-center">
                            </div>
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class=" form-control-label">Check In</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input class="form-control" type="date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Check Out</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <input class="form-control" type="date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Nama</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Tipe Kamar</label>
                                    <select name="select" id="select" class="form-control">
                                        <option value="0">Please select</option>
                                        <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class=" form-control-label">Nomor Telepon</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class=" form-control-label">Kode Parkir</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class=" form-control-label">Kode Ticket</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number">
                                    </div>
                                </div>
                                <small class="form-text text-muted text-right"><strong>**</strong>Jika tidak memiliki kode tiket/ Kode parkir maka dikenakan tarif normal</small>
                                <div class="col-md-3 offset-md-6">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                                        <i class="fa fa-save fa-lg"></i>&nbsp;
                                        <span id="payment-button-amount">Proses Pesanan</span>
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
@endsection