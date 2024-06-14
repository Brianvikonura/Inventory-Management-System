@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Edit Jenis Barang</h4>
                            <form method="POST" action="{{ route('jenisBarang.update', $jenisBarang) }}" class="forms-sample">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="jenisbarang_nama">Jenis Barang</label>
                                    <input type="text"
                                        class="form-control @error('jenisbarang_nama') is-invalid @enderror"
                                        id="jenisbarang_nama" name="jenisbarang_nama"
                                        value="{{ $jenisBarang->jenisbarang_nama }}">
                                    @error('jenisbarang_nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenisbarang_keterangan">Keterangan</label>
                                    <textarea class="form-control @error('jenisbarang_keterangan') is-invalid @enderror" id="jenisbarang_keterangan"
                                        rows="4" name="jenisbarang_keterangan">{{ $jenisBarang->jenisbarang_keterangan }}</textarea>
                                    @error('jenisbarang_keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('jenisBarang.index') }}" class="btn btn-danger mr-1 mt-2 mt-md-0">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
