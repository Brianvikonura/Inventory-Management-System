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
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                                <h4 class="card-title">Data Barang Masuk</h4>
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <div>
                                        <form method="GET" action="{{ route('barangmasuk.index') }}">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search"
                                                    name="barangmasuk_nama">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary"><i
                                                            class="mdi mdi-magnify"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="ms-0 ms-md-2 mt-2 mt-md-0">
                                        <a class="btn btn-primary" href="{{ route('barangmasuk.create') }}">Tambah Data
                                            <i class="fe fe-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> NO </th>
                                        <th> TANGGAL MASUK </th>
                                        <th> KODE BARANG MASUK </th>
                                        <th> KODE BARANG </th>
                                        <th> NAMA BARANG </th>
                                        <th> JUMLAH MASUK </th>
                                        <th> CREATED BY </th>
                                        <th class="text-center"> ACTION </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($barangmasuk as $index => $barangmasuk)
                                        <tr>
                                            <td class="py-1">
                                                {{ $index + 1 }}
                                            </td>
                                            <td> {{ $barangmasuk->barangmasuk_tanggal }} </td>
                                            <td> {{ $barangmasuk->barangmasuk_kode }} </td>
                                            <td> {{ $barangmasuk->barang->barang_kode ?? '-' }} </td>
                                            <td> {{ $barangmasuk->barang->barang_nama ?? '-' }} </td>
                                            <td> {{ $barangmasuk->barangmasuk_jumlah }} </td>
                                            <td> {{ $barangmasuk->users->name ?? '-' }} </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('barangmasuk.edit', ['barangmasuk' => $barangmasuk]) }}"
                                                        class="btn btn-sm btn-warning mx-1">
                                                        <i class="mdi mdi-tooltip-edit"></i> Edit
                                                    </a>

                                                    <form
                                                        action="{{ route('barangmasuk.destroy', ['barangmasuk' => $barangmasuk]) }}"
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
