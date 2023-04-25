@extends('layouts/master')
@section('title')
    Register
@endsection

@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf
            @error('terms')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Username</label>
                <input class="form-control au-input au-input--full @error('password')
                is-invalid @enderror"
                    type="text" name="name" placeholder="Username" value="{{ old('name') }}">

                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input class="form-control au-input au-input--full  @error('password')
                is-invalid @enderror"
                    type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>



            <div class="form-group">
                <label>Phone</label>
                <input class="form-control au-input au-input--full  @error('password')
                is-invalid @enderror"
                    type="string" name="phone" placeholder="09xxxxxxxxxx" value="{{ old('phone') }}">
                @error('phone')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-select">Gender</label>
                <select class=" form-control au-input au-input--full  " name="gender" id="">
                    <option value="">Select Your Gender Here..</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                @error('gender')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>




            <div class="form-group">
                <label>Address</label>
                <input class="form-control au-input au-input--full  @error('password')
                is-invalid @enderror"
                    type="text" name="address" placeholder="UserAddress" value="{{ old('address') }}">


                @error('address')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control au-input au-input--full  @error('password')
                is-invalid @enderror"
                    type="password" name="password" placeholder="Password" value="{{ old('password') }}">

                @error('password')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input class="form-control au-input au-input--full  @error('password')
                is-invalid @enderror"
                    type="password" name="password_confirmation" placeholder="Confirm Password"
                    value="{{ old('password_confirmation') }}">

                @error('password_confirmation')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>



            <button class="form-control au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

        </form>
        <div class="register-link">
            <p>
                Already have account?
                <a href="{{ route('auth#loginPage') }}">Sign In</a>
            </p>
        </div>
    </div>
@endsection
