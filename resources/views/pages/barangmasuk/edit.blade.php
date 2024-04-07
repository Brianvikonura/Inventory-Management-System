@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Edit Data Barang Masuk</h4>
                            <p class="card-description"> <span class="text-danger">*</span> Wajib diisi</p>
                            <form method="POST" action="{{ route('barangmasuk.update', $barangmasuk->barangmasuk_id) }}"
                                class="forms-sample">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="barangmasuk_tanggal">Tanggal Masuk <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="barangmasuk_tanggal"
                                        name="barangmasuk_tanggal" value="{{ $barangmasuk->barangmasuk_tanggal }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="barangmasuk_kode">Kode Barang Masuk <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="barangmasuk_kode" name="barangmasuk_kode"
                                        value="{{ $barangmasuk->barangmasuk_kode }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="barang_kode">Kode Barang <span class="text-danger">*</span></label>
                                    <select class="form-control" id="barang_kode" name="barang_kode" required
                                        onchange="populateNamaBarang()">
                                        <option value="">Pilih Kode Barang</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->barang_kode }}"
                                                {{ $item->barang_kode == $barangmasuk->barang_kode ? 'selected' : '' }}>
                                                {{ $item->barang_kode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="barang_id">Nama Barang <span class="text-danger">*</span></label>
                                    <select class="form-control" id="barang_id" name="barang_id" required disabled>
                                        <option value="">Pilih Nama Barang</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->barang_kode }}"
                                                {{ $item->barang_kode == $barangmasuk->barang_kode ? 'selected' : '' }}>
                                                {{ $item->barang_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="customer_id">Nama Customer <span class="text-danger">*</span></label>
                                    <select class="form-control" id="customer_id" name="customer_id" required>
                                        <option value="">Pilih Nama Customer</option>
                                        @foreach ($customer as $item)
                                            <option value="{{ $item->customer_id }}"
                                                {{ $item->customer_id == $barangmasuk->customer_id ? 'selected' : '' }}>
                                                {{ $item->customer_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="barangmasuk_jumlah">Jumlah Masuk <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="barangmasuk_jumlah"
                                        name="barangmasuk_jumlah" value="{{ $barangmasuk->barangmasuk_jumlah }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                                <a href="{{ route('barangmasuk.index') }}" class="btn btn-danger mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            function populateNamaBarang() {
                var selectedKode = document.getElementById("barang_kode").value;
                var namaBarangSelect = document.getElementById("barang_id");
                var namaBarangOptions = namaBarangSelect.getElementsByTagName("option");
                for (var i = 0; i < namaBarangOptions.length; i++) {
                    if (namaBarangOptions[i].getAttribute("value") === selectedKode) {
                        namaBarangSelect.selectedIndex = i;
                        break;
                    }
                }
            }
        </script>
    @endsection