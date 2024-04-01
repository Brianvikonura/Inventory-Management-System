@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Tambah Data Barang</h4>
                            <p class="card-description"> <span class="text-danger">*</span> Wajib diisi</p>
                            <form method="POST" action="{{ route('barang.store') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="barang_gambar">Gambar Barang</label>
                                    <input type="file" class="form-control" id="barang_gambar" name="barang_gambar"
                                        @error('barang_gambar') is-invalid @enderror>
                                </div>
                                @error('barang_gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label for="barang_kode">Kode Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="barang_kode" name="barang_kode" required>
                                </div>
                                <div class="form-group">
                                    <label for="barang_nama">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="barang_nama" name="barang_nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenisbarang_nama">Jenis Barang <span class="text-danger">*</span></label>
                                    <select class="form-control" id="jenisbarang_id" name="jenisbarang_id" required>
                                        <option value="">Pilih Jenis Barang</option>
                                        @foreach ($jenisBarang as $item)
                                            <option value="{{ $item->jenisbarang_id }}">{{ $item->jenisbarang_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="satuan_id">Satuan <span class="text-danger">*</span></label>
                                    <select class="form-control" id="satuan_id" name="satuan_id" required>
                                        <option value="">Pilih Satuan</option>
                                        @foreach ($satuan as $item)
                                            <option value="{{ $item->satuan_id }}">{{ $item->satuan_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="barang_stok">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="barang_stok" name="barang_stok" required>
                                </div>
                                <div class="form-group">
                                    <label for="barang_harga">Harga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="barang_harga" name="barang_harga" required>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('barang.index') }}" class="btn btn-danger mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
