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
                                <h4 class="card-title">Satuan Barang</h4>
                                <div>
                                    <a class="btn btn-primary" href="{{ route('satuan.create') }}">Tambah Data
                                        <i class="fe fe-plus"></i></a>
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> NO </th>
                                        <th> SATUAN </th>
                                        <th> KETERANGAN </th>
                                        <th class="text-center"> ACTION </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($satuan as $index => $satuan)
                                    <tr>
                                        <td class="py-1">
                                            {{ $index + 1 }}
                                        </td>
                                        <td> {{ $satuan->satuan_nama }} </td>
                                        <td> {{ $satuan->satuan_keterangan }} </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('satuan.edit', ['satuan' => $satuan]) }}" class="btn btn-sm btn-warning mx-1">
                                                    <i class="mdi mdi-tooltip-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('satuan.destroy', ['satuan' => $satuan]) }}" method="POST" class="">
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
