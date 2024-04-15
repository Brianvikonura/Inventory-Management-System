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
                                <h4 class="card-title">Data Barang Keluar</h4>
                                <div>
                                    <a class="btn btn-primary" href="{{ route('barangkeluar.create') }}">Tambah Data
                                        <i class="fe fe-plus"></i></a>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> NO </th>
                                        <th> TANGGAL KELUAR </th>
                                        <th> KODE BARANG KELUAR </th>
                                        <th> KODE BARANG </th>
                                        <th> NAMA BARANG </th>
                                        <th> CUSTOMER </th>
                                        <th> JUMLAH KELUAR </th>
                                        <td> CREATED BY </td>
                                        <th> INVOICE </th>
                                        <th class="text-center"> ACTION </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($barangkeluar as $index => $barangkeluar)
                                        <tr>
                                            <td class="py-1">
                                                {{ $index + 1 }}
                                            </td>
                                            <td> {{ $barangkeluar->barangkeluar_tanggal }} </td>
                                            <td> {{ $barangkeluar->barangkeluar_kode }} </td>
                                            <td> {{ $barangkeluar->barang->barang_kode ?? '-' }} </td>
                                            <td> {{ $barangkeluar->barang->barang_nama ?? '-' }} </td>
                                            <td> {{ $barangkeluar->customer->customer_nama ?? '-' }} </td>
                                            <td> {{ $barangkeluar->barangkeluar_jumlah }} </td>
                                            <td> {{ $barangkeluar->users->name ?? '-' }} </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="#" class="btn btn-info btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                                        <i class="mdi mdi-file-document"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('barangkeluar.edit', ['barangkeluar' => $barangkeluar]) }}"
                                                        class="btn btn-sm btn-warning mx-1">
                                                        <i class="mdi mdi-tooltip-edit"></i> Edit
                                                    </a>

                                                    <form
                                                        action="{{ route('barangkeluar.destroy', ['barangkeluar' => $barangkeluar]) }}"
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
