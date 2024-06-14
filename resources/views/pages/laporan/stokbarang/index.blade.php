@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-12">
                                    @include('layouts.alert')
                                </div>
                            </div>
                            <form method="GET" action="{{ route('laporan.stokbarang.index') }}">
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                    <h4 class="card-title">Laporan Stok Barang</h4>
                                    <div class="mb-2 mb-md-0">
                                        <div class="input-group mb-0 mb-md-2">
                                            <input type="text" class="form-control" placeholder="Search"
                                                name="nama_barang" value="{{ request('nama_barang') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i
                                                        class="mdi mdi-magnify"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <div class="input-group mb-2">
                                                <div class="input-group-append ms-0">
                                                    <a href="{{ route('laporan.stokbarang.index') }}"
                                                        class="btn btn-warning ml-4 ml-md-2 mt-md-0"><i
                                                            class="mdi mdi-undo-variant"></i>
                                                        Reset</a>
                                                    <a href="{{ route('laporan.stokbarang.viewPdf', [
                                                        'nama_barang' => request('nama_barang'),
                                                    ]) }}"
                                                        target="_blank" class="btn btn-info ml-2 mt-2 mt-md-0"><i
                                                            class="mdi mdi-eye"></i> View PDF</a>
                                                    <a href="{{ route('laporan.stokbarang.pdf', [
                                                        'nama_barang' => request('nama_barang'),
                                                    ]) }}"
                                                        class="btn btn-danger ml-2 mt-2 mt-md-0"><i
                                                            class="mdi mdi-download-outline"></i>
                                                        Download
                                                        PDF</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> NO </th>
                                        <th> JENIS BARANG </th>
                                        <th> KODE BARANG </th>
                                        <th> NAMA BARANG </th>
                                        <th> TOTAL STOK </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barang as $index => $barang)
                                        <tr>
                                            <td class="py-1">{{ $index + 1 }}</td>
                                            <td> {{ $barang->jenis->jenisbarang_nama ?? '-' }} </td>
                                            <td> {{ $barang->barang_kode }} </td>
                                            <td> {{ $barang->barang_nama }} </td>
                                            <td> {{ $barang->barang_stok }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <!-- JS Libraries -->

        <!-- Page Specific JS File -->
    @endpush
