@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Edit Data Ekspedisi</h4>
                            <form method="POST" action="{{ route('ekspedisi.update', $ekspedisi) }}" class="forms-sample">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="ekspedisi_jenis">Jenis Ekspedisi</label>
                                    <input type="text"
                                        class="form-control @error('ekspedisi_jenis') is-invalid @enderror"
                                        id="ekspedisi_jenis" name="ekspedisi_jenis"
                                        value="{{ $ekspedisi->ekspedisi_jenis }}">
                                    @error('ekspedisi_jenis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ekspedisi_keterangan">Keterangan</label>
                                    <textarea class="form-control @error('ekspedisi_keterangan') is-invalid @enderror" id="ekspedisi_keterangan"
                                        rows="4" name="ekspedisi_keterangan">{{ $ekspedisi->ekspedisi_keterangan }}</textarea>
                                    @error('ekspedisi_keterangan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('ekspedisi.index') }}" class="btn btn-danger mr-1 mt-2 mt-md-0">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
