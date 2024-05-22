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
                            <form method="GET" action="{{ route('laporan.barangkeluar.index') }}">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title">Laporan Barang Keluar</h4>
                                    <div>
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" placeholder="Search"
                                                name="barangkeluar_nama" value="{{ request('barangkeluar_nama') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i
                                                        class="mdi mdi-account-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <div class="d-flex justify-content-between">
                                            <div class="input-group mb-2">
                                                <select class="form-control px-5" name="filter_waktu">
                                                    <option value="">Pilih Periode Waktu</option>
                                                    <option value="1_bulan"
                                                        {{ request('filter_waktu') == '1_bulan' ? 'selected' : '' }}>1 Bulan
                                                        Terakhir</option>
                                                    <option value="3_bulan"
                                                        {{ request('filter_waktu') == '3_bulan' ? 'selected' : '' }}>3 Bulan
                                                        Terakhir</option>
                                                    <option value="6_bulan"
                                                        {{ request('filter_waktu') == '6_bulan' ? 'selected' : '' }}>6 Bulan
                                                        Terakhir</option>
                                                    <option value="1_tahun"
                                                        {{ request('filter_waktu') == '1_tahun' ? 'selected' : '' }}>1 Tahun
                                                        Terakhir</option>
                                                </select>
                                                <div class="input-group-append ms-2">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="mdi mdi-filter-outline"></i> Filter</button>
                                                    <a href="{{ route('laporan.barangkeluar.index') }}"
                                                        class="btn btn-warning ml-2"><i class="mdi mdi-undo-variant"></i>
                                                        Reset</a>
                                                    <a href="{{ route('laporan.barangkeluar.viewPdf', [
                                                        'barangkeluar_nama' => request('barangkeluar_nama'),
                                                        'filter_waktu' => request('filter_waktu'),
                                                    ]) }}"
                                                        target="_blank" class="btn btn-info ml-2"><i
                                                            class="mdi mdi-eye"></i> View PDF</a>
                                                    <a href="{{ route('laporan.barangkeluar.pdf', [
                                                        'barangkeluar_nama' => request('barangkeluar_nama'),
                                                        'filter_waktu' => request('filter_waktu'),
                                                    ]) }}"
                                                        class="btn btn-danger ml-2"><i class="mdi mdi-download-outline"></i>
                                                        Unduh
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
                                        <th> TANGGAL KELUAR </th>
                                        <th> KODE INVOICE </th>
                                        <th> NAMA BARANG </th>
                                        <th> CUSTOMER </th>
                                        <th> JUMLAH KELUAR </th>
                                        <th> HARGA </th>
                                        <th> SUBTOTAL </th>
                                        <th> ONGKIR </th>
                                        <th> TOTAL </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangkeluar as $index => $barang)
                                        <tr>
                                            <td class="py-1">{{ $index + 1 }}</td>
                                            <td>{{ $barang->barangkeluar_tanggal ?? '-' }}</td>
                                            <td>{{ implode(', ', $barang->details->pluck('barang.barang_kode')->toArray()) ?? '-' }}
                                            </td>
                                            <td>{{ implode(', ', $barang->details->pluck('barang.barang_nama')->toArray()) ?? '-' }}
                                            </td>
                                            <td>{{ $barang->customer->customer_nama ?? '-' }}</td>
                                            <td>{{ implode(', ', $barang->details->pluck('barangkeluar_jumlah')->toArray()) ?? '-' }}
                                            </td>
                                            <td>$
                                                {{ implode(', $ ', $barang->details->pluck('barangkeluar_harga')->toArray()) ?? '-' }}
                                            </td>
                                            <td>$
                                                {{ implode(', $ ', $barang->details->pluck('barangkeluar_subtotal')->toArray()) ?? '-' }}
                                            </td>
                                            <td>$ {{ $barang->barangkeluar_ongkir }}</td>
                                            <td>$ {{ $barang->barangkeluar_total }}</td>
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
