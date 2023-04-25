@extends('layouts/master')

@section('title')
    Login
@endsection
@section('content')
    <div class="login-form">
        @error('terms')
            <div class="invalid-feedback"> {{ $message }}</div>
        @enderror
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input name="email" class="form-control au-input au-input--full @error('email') is-invalid @enderror"
                    type="email" placeholder="Email">

                @error('email')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label>Password</label>
                <input name="password"
                    class=" form-control au-input au-input--full @error('password')
                is-invalid

                @enderror"
                    type="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>

            <div class="mt-5">
                <button class="au-btn au-btn--block au-btn--green m-b-20 mt-4" type="submit">sign in</button>
            </div>

        </form>
        <div class="register-link">
            <p>
                Don't you have account?
                <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>

            </p>
        </div>
    </div>
@endsection
