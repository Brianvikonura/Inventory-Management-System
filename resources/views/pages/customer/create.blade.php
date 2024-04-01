@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Tambah Data Customer</h4>
                            <p class="card-description"> <span class="text-danger">*</span>Wajib diisi</p>
                            <form method="POST" action="{{ route('customer.store') }}" class="forms-sample">
                                @csrf
                                <div class="form-group">
                                    <label for="customer_nama">Nama Customer <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="customer_nama" name="customer_nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_alamat">Alamat Customer <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="customer_alamat" name="customer_alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_notelp">No Telp Customer <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="customer_notelp" name="customer_notelp" required>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('customer.index') }}" class="btn btn-danger mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
