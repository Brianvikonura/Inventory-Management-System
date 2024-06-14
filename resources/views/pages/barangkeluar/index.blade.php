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
                                <h4 class="card-title">Data Barang Keluar</h4>
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <div>
                                        <form method="GET" action="{{ route('barangkeluar.index') }}">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search"
                                                    name="barangkeluar_nama">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary"><i
                                                            class="mdi mdi-magnify"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="ms-0 ms-md-2 mt-2 mt-md-0">
                                        <a class="btn btn-primary" href="{{ route('barangkeluar.create') }}">Tambah Data <i
                                                class="fe fe-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL KELUAR</th>
                                        <th>KODE BARANG KELUAR</th>
                                        <th>NAMA BARANG</th>
                                        <th>CUSTOMER</th>
                                        <th>JUMLAH KELUAR</th>
                                        <th>CREATED BY</th>
                                        <th>INVOICE</th>
                                        <th class="text-center">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = ($barangkeluarPaginated->currentPage() - 1) * $barangkeluarPaginated->perPage() + 1 @endphp
                                    @foreach ($barangkeluarPaginated as $barangkeluar)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $barangkeluar->barangkeluar_tanggal }}</td>
                                            <td>{{ $barangkeluar->barangkeluar_kode }}</td>
                                            <td>
                                                @php $nama_barang = [] @endphp
                                                @foreach ($barangkeluar->details as $detail)
                                                    @php
                                                        $nama = $detail->barang->barang_nama ?? '-';
                                                        if (!in_array($nama, $nama_barang)) {
                                                            $nama_barang[] = $nama;
                                                            echo $nama;
                                                            if (!$loop->last) {
                                                                echo ', ';
                                                            }
                                                        }
                                                    @endphp
                                                @endforeach
                                            </td>
                                            <td>{{ $barangkeluar->customer->customer_nama ?? '-' }}</td>
                                            <td>{{ $barangkeluar->details->sum('barangkeluar_jumlah') }}</td>
                                            <td>{{ $barangkeluar->users->name ?? '-' }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('invoice-pdf', ['barangkeluar_kode' => $barangkeluar->barangkeluar_kode]) }}"
                                                        class="btn btn-info btn-rounded btn-icon d-flex justify-content-center align-items-center">
                                                        <i class="mdi mdi-file-document"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('barangkeluar.edit', ['barangkeluar_kode' => $barangkeluar->barangkeluar_kode]) }}"
                                                        class="btn btn-sm btn-warning mx-1">
                                                        <i class="mdi mdi-tooltip-edit"></i> Edit
                                                    </a>
                                                    <form
                                                        action="{{ route('barangkeluar.destroy', $barangkeluar->barangkeluar_kode) }}"
                                                        method="POST">
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
                            <div class="mt-3">
                                {{ $barangkeluarPaginated->links() }}
                            </div>
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
