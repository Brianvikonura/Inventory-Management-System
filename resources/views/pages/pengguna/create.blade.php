@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->has('password') || $errors->has('password_confirmation'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <div class="d-flex justify-content-between align-items-center">
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    {{ $errors->first('password') ?: $errors->first('password_confirmation') }}
                                </div>
                            @endif
                            <h4 class="card-title">Form Tambah Data Pengguna</h4>
                            <p class="card-description"> <span class="text-danger">*</span>Wajib diisi</p>
                            <form method="POST" action="{{ route('pengguna.store') }}" class="forms-sample">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Role</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="role" value="superadmin"
                                                class="selectgroup-input" checked="">
                                            <span class="selectgroup-button">Super Admin</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="role" value="admin" class="selectgroup-input">
                                            <span class="selectgroup-button">Admin</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('pengguna.index') }}" class="btn btn-danger mr-1">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
