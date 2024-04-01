@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Edit Data Custmomer</h4>
                            <form method="POST" action="{{ route('customer.update', $customer) }}" class="forms-sample">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="customer_nama">Nama Customer</label>
                                    <input type="text"
                                        class="form-control @error('customer_nama') is-invalid @enderror"
                                        id="customer_nama" name="customer_nama"
                                        value="{{ $customer->customer_nama }}">
                                    @error('customer_nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="customer_alamat">Alamat Customer</label>
                                    <input type="text"
                                        class="form-control @error('customer_alamat') is-invalid @enderror"
                                        id="customer_alamat" name="customer_alamat"
                                        value="{{ $customer->customer_alamat }}">
                                    @error('customer_alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="customer_notelp">No Telp Customer</label>
                                    <input type="text"
                                        class="form-control @error('customer_notelp') is-invalid @enderror"
                                        id="customernotelpa" name="customer_notelp"
                                        value="{{ $customer->customer_notelp }}">
                                    @error('customer_notelp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
