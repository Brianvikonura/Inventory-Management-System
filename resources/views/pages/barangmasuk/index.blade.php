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
                                <h4 class="card-title">Data Barang Masuk</h4>
                                <div>
                                    <a class="btn btn-primary" href="{{ route('barangmasuk.create') }}">Tambah Data
                                        <i class="fe fe-plus"></i></a>
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
                                        <th> CUSTOMER </th>
                                        <th> JUMLAH MASUK </th>
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
                                            <td> {{ $barangmasuk->customer->customer_nama }} </td>
                                            <td> {{ $barangmasuk->barangmasuk_jumlah }} </td>
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