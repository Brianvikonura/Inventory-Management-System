@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
            </div>
            <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Total Stok Barang <i
                                    class="mdi mdi-file-cabinet mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $totalStokBarang }} Barang</h2>
                            <h6 class="card-text">{{ $totalJenisBarang }} Jenis</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Total Barang Masuk <i
                                    class="mdi mdi-bookmark-plus mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $totalBarangMasuk }} Barang</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="{{ asset('images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Total Barang Keluar <i
                                    class="mdi mdi-ferry mdi-24px float-right"></i>
                            </h4>
                            <h2 class="mb-5">{{ $totalBarangKeluar }} Barang</h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role == 'superadmin')
                <div class="row">
                    <div class="col-md-7 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="clearfix">
                                    <h4 class="card-title float-left">Statistik Penjualan
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                    </h4>
                                </div>
                                {!! $salesChart->container() !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Stok Barang</h4>
                                {!! $stockChart->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <script src="{{ $salesChart->cdn() }}"></script>
        <script src="{{ $stockChart->cdn() }}"></script>

        {{ $salesChart->script() }}
        {{ $stockChart->script() }}
    @endsection
