@extends('layouts.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @include('layouts.alert')
                                </div>
                            </div>
                            <h4 class="card-title">Pengaturan Akun</h4>
                            <p class="card-description"></p>
                            <form method="POST" action="{{ route('settings.update', $user->id) }}">
                                @csrf
                                @method('PUT')

                                @if (Auth::user()->role == 'superadmin')
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nama Lengkap" value="{{ old('name') ?? auth()->user()->name }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Alamat Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Alamat Email" value="{{ old('email') ?? auth()->user()->email }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="old_password">Password Sekarang</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password"
                                            placeholder="Password Sekarang">
                                        @error('old_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password Baru</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password Baru">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Konfirmasi Password Baru">
                                    </div>
                                @elseif (Auth::user()->role == 'admin')
                                    <div class="form-group">
                                        <label for="old_password">Password Sekarang</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password"
                                            placeholder="Password Sekarang">
                                        @error('old_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password Baru</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password Baru">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Konfirmasi Password Baru">
                                    </div>
                                @endif

                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                <a href="{{ route('home') }}" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
