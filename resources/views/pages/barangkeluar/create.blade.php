@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Tambah Data Barang Keluar</h4>
                            <p class="card-description"> <span class="text-danger">*</span> Wajib diisi</p>
                            <form method="POST" action="{{ route('barangkeluar.store') }}" class="forms-sample">
                                @csrf
                                <div class="form-group">
                                    <label for="barangkeluar_tanggal">Tanggal Keluar <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="barangkeluar_tanggal"
                                        name="barangkeluar_tanggal" required>
                                </div>
                                <div class="form-group">
                                    <label for="barangkeluar_kode">Kode Barang Keluar <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="barangkeluar_kode"
                                        name="barangkeluar_kode" required>
                                </div>
                                <div class="form-group">
                                    <label for="barang_id">Nama Barang <span class="text-danger">*</span></label>
                                    <select class="form-control" id="barang_id" name="barang_id" required>
                                        <option value="">Pilih Nama Barang</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="customer_nama">Nama Customer <span class="text-danger">*</span></label>
                                    <select class="form-control" id="customer_id" name="customer_id" required>
                                        <option value="">Pilih Nama Customer</option>
                                        @foreach ($customer as $item)
                                            <option value="{{ $item->customer_id }}">{{ $item->customer_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="barangkeluar_jumlah">Jumlah keluar <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="barangkeluar_jumlah"
                                        name="barangkeluar_jumlah" required>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('barangkeluar.index') }}" class="btn btn-danger mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
