@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="auth-form-light text-left p-5">
        <div class="text-center mb-4">
            <div class="brand-logo mb-2">
                <img src="{{ asset('images/logo.png') }}" alt="logo" style="width: 120px">
            </div>
            <h4 class="mb-0">Inventory Management System</h4>
        </div>
        <h4>Hello! let's get started</h4>
        <h6 class="font-weight-light">Sign in to continue.</h6>

        <form method="POST" action="{{ route('login') }}" class="needs-validation pt-3" novalidate="">
            @csrf
            <div class="form-group">
                <input id="email" type="email"
                    class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email"
                    name="email" value="{{ old('email') }}" tabindex="1" autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password"
                    class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password"
                    name="password" tabindex="2">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mt-3">
                <button type="submit"
                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn w-100" tabindex="4">
                    SIGN IN
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->

    <!-- Page Specific JS File -->
@endpush
