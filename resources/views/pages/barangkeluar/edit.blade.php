@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Edit Data Barang Keluar</h4>
                            <p class="card-description"> <span class="text-danger">*</span> Wajib diisi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST"
                                action="{{ route('barangkeluar.update', $barangkeluar->barangkeluar_kode) }}"
                                class="forms-sample">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="barangkeluar_tanggal">Tanggal Pemesanan <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="barangkeluar_tanggal"
                                        name="barangkeluar_tanggal" value="{{ $barangkeluar->barangkeluar_tanggal }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="barangkeluar_kode">Kode Barang Keluar <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="barangkeluar_kode"
                                        name="barangkeluar_kode" value="{{ $barangkeluar->barangkeluar_kode }}" required
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="customer_nama">Nama Customer <span class="text-danger">*</span></label>
                                    <select class="form-control" id="customer_id" name="customer_id" required>
                                        <option value="">Pilih Nama Customer</option>
                                        @foreach ($customer as $item)
                                            <option value="{{ $item->customer_id }}"
                                                {{ $item->customer_id == $barangkeluar->customer_id ? 'selected' : '' }}>
                                                {{ $item->customer_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="barang">
                                    @foreach ($barangkeluar->details as $index => $barangkeluarDetail)
                                        <input type="hidden" name="detail_id[]"
                                            value="{{ $barangkeluarDetail->detail_id }}">
                                        <div class="form-group">
                                            <label for="barang_id">Nama Barang <span class="text-danger">*</span></label>
                                            <select class="form-control barang" id="barang_id_{{ $index }}"
                                                name="barang_id[{{ $index }}]" required>
                                                <option value="">Pilih Nama Barang</option>
                                                @foreach ($barang as $barangItem)
                                                    <option value="{{ $barangItem->barang_id }}"
                                                        {{ $barangItem->barang_id == $barangkeluarDetail->barang_id ? 'selected' : '' }}>
                                                        {{ $barangItem->barang_nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="barangkeluar_jumlah">Jumlah keluar <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control jumlah"
                                                id="barangkeluar_jumlah_{{ $index }}"
                                                name="barangkeluar_jumlah[{{ $index }}]"
                                                value="{{ $barangkeluarDetail->barangkeluar_jumlah }}" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="barangkeluar_harga">Harga Per-Barang <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control barangkeluar_harga"
                                                    id="barangkeluar_harga_{{ $index }}"
                                                    name="barangkeluar_harga[{{ $index }}]"
                                                    value="{{ $barangkeluarDetail->barangkeluar_harga }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="barangkeluar_subtotal">Subtotal <span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control barangkeluar_subtotal"
                                                    id="barangkeluar_subtotal_{{ $index }}"
                                                    name="barangkeluar_subtotal[{{ $index }}]"
                                                    value="{{ $barangkeluarDetail->barangkeluar_subtotal }}" required
                                                    readonly>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ekspedisi_id">Nama Eskpedisi <span class="text-danger">*</span></label>
                                <select class="form-control" id="ekspedisi_id" name="ekspedisi_id" required>
                                    <option value="">Pilih Nama Ekspedisi</option>
                                    @foreach ($ekspedisi as $item)
                                        <option value="{{ $item->ekspedisi_id }}"
                                            {{ $item->ekspedisi_id == $barangkeluar->ekspedisi_id ? 'selected' : '' }}>
                                            {{ $item->ekspedisi_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="barangkeluar_ongkir">Biaya Pengiriman <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="barangkeluar_ongkir"
                                    name="barangkeluar_ongkir" value="{{ $barangkeluar->barangkeluar_ongkir }}" required>
                            </div>
                            <div class="form-group">
                                <label for="barangkeluar_total">Total <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="barangkeluar_total"
                                    name="barangkeluar_total" value="{{ $barangkeluar->barangkeluar_total }}" required
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 grid-margin stretch-card mt-3">
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ route('barangkeluar.index') }}"
                                class="btn btn-danger mr-1 mt-2 mt-md-0">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Calculate subtotal and total
                $(document).on('input', '.jumlah, .barangkeluar_harga, #barangkeluar_ongkir', function() {
                    var index = $(this).attr('id').split('_').pop();
                    calculateSubtotal(index);
                    calculateTotal();
                });

                function calculateSubtotal(index) {
                    var jumlah = parseFloat($('#barangkeluar_jumlah_' + index).val());
                    var harga = parseFloat($('#barangkeluar_harga_' + index).val());
                    var subtotal = jumlah * harga;
                    $('#barangkeluar_subtotal_' + index).val(subtotal.toFixed(2));
                }

                function calculateTotal() {
                    var subtotalTotal = 0;
                    $('.barangkeluar_subtotal').each(function() {
                        subtotalTotal += parseFloat($(this).val()) || 0;
                    });

                    var ongkir = parseFloat($('#barangkeluar_ongkir').val()) || 0;
                    var total = subtotalTotal + ongkir;
                    $('#barangkeluar_total').val(total.toFixed(2));
                }
            });
        </script>
    @endpush
