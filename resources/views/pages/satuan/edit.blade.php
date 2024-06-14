@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Edit Satuan Barang</h4>
                            <form method="POST" action="{{ route('satuan.update', $satuan) }}" class="forms-sample">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="satuan_nama">Jenis Barang</label>
                                    <input type="text"
                                        class="form-control @error('satuan_nama') is-invalid @enderror"
                                        id="satuan_nama" name="satuan_nama"
                                        value="{{ $satuan->satuan_nama }}">
                                    @error('satuan_nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="satuan_keterangan">Keterangan</label>
                                    <textarea class="form-control @error('satuan_keterangan') is-invalid @enderror" id="satuan_keterangan"
                                        rows="4" name="satuan_keterangan">{{ $satuan->satuan_keterangan }}</textarea>
                                    @error('satuan_keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('satuan.index') }}" class="btn btn-danger mr-1 mt-2 mt-md-0">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
