@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body table-responsive">
                            {{-- <div class="row">
                                <div class="col-12">
                                    @include('layouts.alert')
                                </div>
                            </div> --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title">Data Barang</h4>
                                <div>
                                    <a class="btn btn-primary" href="{{ route('barang.create') }}">Tambah Data
                                        <i class="fe fe-plus"></i></a>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> NO </th>
                                        <th> GAMBAR </th>
                                        <th> KODE BARANG </th>
                                        <th> NAMA BARANG </th>
                                        <th> JENIS </th>
                                        <th> SATUAN </th>
                                        <th> STOK </th>
                                        <th> HARGA </th>
                                        <th class="text-center"> ACTION </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($barang as $index => $barang)
                                        <tr>
                                            <td class="py-1">
                                                {{ $index + 1 }}
                                            </td>
                                            <td>
                                                <img src="{{ asset($barang->barang_gambar) }}" alt="Gambar Barang" style="max-width: 100px;">
                                            </td>
                                            <td> {{ $barang->barang_kode }} </td>
                                            <td> {{ $barang->barang_nama }} </td>
                                            <td> {{ $barang->jenis->jenisbarang_nama ?? '-' }} </td>
                                            <td> {{ $barang->satuan->satuan_nama ?? '-' }} </td>
                                            <td> {{ $barang->barang_stok }} </td>
                                            <td> {{ $barang->barang_harga }} </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('barang.edit', ['barang' => $barang]) }}"
                                                        class="btn btn-sm btn-warning mx-1">
                                                        <i class="mdi mdi-tooltip-edit"></i> Edit
                                                    </a>

                                                    <form action="{{ route('barang.destroy', ['barang' => $barang]) }}"
                                                        method="POST" class="">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger confirm-delete">
                                                            <i class="mdi mdi-delete-forever"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
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
        <!-- JS Libraies -->

        <!-- Page Specific JS File -->
    @endpush
