@extends('layouts.auth')

@section('content')
    <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
            <img src="{{ asset('images/logo.svg') }}">
        </div>
        <h4>Hello! let's get started</h4>
        <h6 class="font-weight-light">Sign in to continue.</h6>
        <form class="pt-3">
            @csrf
            <div class="form-group">
                <input id="email" type="email" class="form-control form-control-lg"
                    placeholder="Email @error('email')
                is-invalid
            @enderror" name="email"
                    tabindex="1" autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control form-control-lg"
                    placeholder="Password
                @error('password')
                        is-invalid
                    @enderror"
                    name="password" tabindex="2">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn w-100" tabindex="4">
                    SIGN IN
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
