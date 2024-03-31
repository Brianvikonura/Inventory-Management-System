@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Tambah Jenis Barang</h4>
                            <p class="card-description"> <span class="text-danger">*</span>Wajib diisi</p>
                            <form method="POST" action="{{ route('jenisBarang.store') }}" class="forms-sample">
                                @csrf
                                <div class="form-group">
                                    <label for="jenisbarang_nama">Jenis Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="jenisbarang_nama" name="jenisbarang_nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenisbarang_keterangan">Keterangan</label>
                                    <textarea class="form-control" id="jenisbarang_keterangan" name="jenisbarang_keterangan" rows="4"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('jenisBarang.index') }}" class="btn btn-danger mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
