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
                                <h4 class="card-title">Jenis Barang</h4>
                                <div class="d-flex flex-column flex-md-row justify-content-between">
                                    <div class="mb-2 mb-md-0">
                                        <form method="GET" action="{{ route('jenisBarang.index') }}">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search"
                                                    name="jenisbarang_nama">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary"><i
                                                            class="mdi mdi-magnify"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="ms-0 ms-md-2">
                                        <a class="btn btn-primary" href="{{ route('jenisBarang.create') }}">Tambah Data
                                            <i class="fe fe-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> NO </th>
                                        <th> JENIS BARANG </th>
                                        <th> KETERANGAN </th>
                                        <th> CREATED BY </th>
                                        <th class="text-center"> ACTION </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($jenisbarang as $index => $jenisbarang)
                                        <tr>
                                            <td class="py-1">
                                                {{ $index + 1 }}
                                            </td>
                                            <td> {{ $jenisbarang->jenisbarang_nama }} </td>
                                            <td> {{ $jenisbarang->jenisbarang_keterangan }} </td>
                                            <td> {{ $jenisbarang->users->name ?? '-' }} </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('jenisBarang.edit', ['jenisBarang' => $jenisbarang]) }}"
                                                        class="btn btn-sm btn-warning mx-1">
                                                        <i class="mdi mdi-tooltip-edit"></i> Edit
                                                    </a>

                                                    <form
                                                        action="{{ route('jenisBarang.destroy', ['jenisBarang' => $jenisbarang]) }}"
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
